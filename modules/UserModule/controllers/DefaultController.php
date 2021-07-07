<?php

namespace app\modules\UserModule\controllers;

use app\models\PostForm;
use app\models\Posts;
use app\models\SignupForm;
use app\models\User;
use app\models\UserForm;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->id) {
            return $this->redirect('/auth/login');
        }

        $model = new UserForm();


        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile) {
                $user = Yii::$app->user;
                if (is_string($uploadFile_name = $model->upload($user))) {
                    $user2 = User::findOne($user->id);
                    $user2->main_image = $uploadFile_name;
                    $user2->save(false);
                }
            }
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionView($id){
        $user2 = User::findOne($id);
        if(!$user2){
            return 404;
        }

        return $this->render('view', ['model' => $user2]);
    }

    public function actionTest(){
        $user2 = User::findOne(1);


        return $this->render('test', ['model' => $user2]);
    }

}
