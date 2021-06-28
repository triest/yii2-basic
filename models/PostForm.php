<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PostForm extends Model
{
        public $title;
        public $description;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['title', 'description'], 'required'],
            // email has to be a valid email address
        ];
    }



}
