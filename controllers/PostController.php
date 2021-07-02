<?php

namespace app\controllers;

use app\models\CommentForm;
use yii\helpers\VarDumper;
use app\models\PostForm;
use app\models\Posts;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class PostController extends Controller
{

    public $upload_path='images/';
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $posts=Posts::find()->all();

        return $this->render('index',['posts'=>$posts]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->id){
            return $this->redirect('/auth/login');
        }

        $model = new PostForm();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $post=new Posts();
            $post->title=$model->title;
            $post->description=$model->description;
            $post->author_id=Yii::$app->user->id;
            if ($model->imageFile ) {
                  if(is_string($uploadFile_name=$model->upload())){
                      $post->main_image=$uploadFile_name;
                  }
            }
            $post->save(false);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id){

        $post=Posts::findOne($id);

        $commentForm=new CommentForm();



        return $this->render('view', [
                'post' => $post,'commentForm'=>$commentForm
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
