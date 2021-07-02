<?php

namespace app\controllers;

use app\models\Comment;
use app\models\CommentForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class CommentController extends Controller
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

    public function actionSend(){

        $model=new CommentForm();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
                  $comment=new Comment();
                  $comment->text=$model->description;
                  $comment->post_id=$model->post_id;
                  $comment->user_id=Yii::$app->user->identity;
                  $comment->save(false);
        }
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

    }
}
