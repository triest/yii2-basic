<?php


namespace app\controllers;


use app\models\Posts;
use yii\web\Controller;

class ApiController  extends Controller
{



    protected function verbs()
    {
        return [
                'index' => ['GET', 'HEAD'],
                'view' => ['GET', 'HEAD'],
                'create' => ['POST'],
                'update' => ['PUT', 'PATCH'],
                'delete' => ['DELETE'],
        ];
    }

    public function actionIndex(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Posts::find()->all();

    }

    public function actionView($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post=Posts::findOne($id);
        return $post;
    }
}
