<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * ContactForm is the model behind the contact form.
 */
class CommentForm extends Model
{
        public $user_name;
        public $description;
        public $post_id;


    public function rules()
    {
        return [
                [['user_name', 'description','post_id'], 'required'],
        ];
    }




}
