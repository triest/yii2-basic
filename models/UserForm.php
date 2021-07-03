<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * ContactForm is the model behind the contact form.
 */
class UserForm extends Model
{
    public $title;
    public $description;

    public $uploadDirecoty = 'uploads/users/';

    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
                [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($user)
    {
        if ($this->validate()) {


            $name = $this->random_filename(30) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($this->uploadDirecoty . $name);

            return $name;
        } else {
            return false;
        }
    }

    function random_filename($length, $extension = '')
    {
        $directory = $this->uploadDirecoty;

        // default to this files directory if empty...
        $dir = !empty($directory) && is_dir($directory) ? $directory : dirname(__FILE__);

        do {
            $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));

            for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
            }
        } while (file_exists($dir . '/' . $key . (!empty($extension) ? '.' . $extension : '')));

        return $key . (!empty($extension) ? '.' . $extension : '');
    }


}
