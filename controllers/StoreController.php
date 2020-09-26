<?php

    namespace app\controllers;

    use app\jobs\ImportJob;
    use app\models\Import;
    use app\models\Store;
    use app\models\UploadForm;
    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\Response;
    use yii\filters\VerbFilter;
    use app\models\LoginForm;
    use app\models\ContactForm;
    use yii\web\UploadedFile;

    class StoreController extends Controller
    {
        /**
         * {@inheritdoc}
         */
        public function behaviors()
        {
            return [
                    'access' => [
                            'class' => AccessControl::className(),
                            'only' => ['logout'],
                            'rules' => [
                                    [
                                            'actions' => ['logout'],
                                            'allow' => true,
                                            'roles' => ['@'],
                                    ],
                            ],
                    ],
                    'verbs' => [
                            'class' => VerbFilter::className(),
                            'actions' => [
                                    'logout' => ['post'],
                            ],
                    ],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function actions()
        {
            return [
                    'error' => [
                            'class' => 'yii\web\ErrorAction',
                    ],
                    'captcha' => [
                            'class' => 'yii\captcha\CaptchaAction',
                            'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                    ],
            ];
        }

        public function actionUpload()
        {

            $model = new UploadForm();

            if (Yii::$app->request->isPost) {
                $file = UploadedFile::getInstance($model, 'datafile');
                if ($file != null) {

                    $store_id = Yii::$app->request->post('store_id');
                    $import = new Import();
                    $filename = $import->upload($file);

                    $id = Yii::$app->queue->push(new ImportJob([
                            'file' => Yii::$app->basePath . '/web/uploads/' . $store_id . '/' . $filename,
                            'store_id' => $store_id
                    ]));
                    $import->job_id = $id;
                    $import->store_id = $store_id;
                    $import->save();
                }
            }
            $stores = Store::find()->all();
            return $this->render('upload', ['model' => $model, 'stores' => $stores]);

        }
    }

