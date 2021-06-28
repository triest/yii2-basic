<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;

class SignupForm extends Model
{
    public $username;
    public $name;
    public $email;
    public $password;
    public $fio;
    public $phone;
    public $password_repeat;
    public $verifyCode;

    public function rules()
    {
        return [
                [['username', 'password'], 'required'],
                ['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
        ];
    }

    public function attributes()
    {
        return [
                'id',
                'name',
                'password',
                'name',
                'email',
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
                'verifyCode' => 'Verification Code',
        ];
    }


    public function signup()
    {

        if ($this->validate()) {
            $user = new User();
            //    $user->attributes = $this->attributes;
            $user->username = $this->username;
            $user->email = $this->email;
            $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->password=$hash;
            $user->save();
            var_dump($user); die();
            return $user;
        } else {
            // validation failed: $errors is an array containing error messages
            return $this->errors;
        }

    }

}
