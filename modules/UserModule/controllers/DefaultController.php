<?php

namespace app\modules\UserModule\controllers;

use app\models\PostForm;
use app\models\Posts;
use app\models\SignupForm;
use app\models\User;
use app\models\UserForm;
use Yii;
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

        return $this->render('index', ['model' => $model]);
    }


}
