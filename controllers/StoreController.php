<?php

namespace app\controllers;

use app\models\UploadForm;
use frontend\jobs\ImportJob;
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

   public function actionUpload(){

       $model = new UploadForm();

       if (Yii::$app->request->isPost) {
           $model->datafile = UploadedFile::getInstance($model, 'datafile');
           if ($model->upload()) {
               $id = Yii::$app->queue->push(new ImportJob([
                       'file' => Yii::$app->basePath . '/web/file.txt'
               ]));

           }
       }

       return $this->render('upload', ['model' => $model]);

   }
}
