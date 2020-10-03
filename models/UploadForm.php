<?php

    namespace app\models;

    use Yii;
    use yii\base\Model;

    /**
     * LoginForm is the model behind the login form.
     *
     * @property User|null $user This property is read-only.
     *
     */
    class UploadForm extends Model
    {
        public $datafile;
        public $store_id;

        /**
         * @return array the validation rules.
         */
        public function rules()
        {
            return [
                    [['datafile'], 'required'],
                    [['datafile'], 'file'],
                    [['store_id'], 'required'],
                    ['store_id', 'exist', 'targetClass' => '\app\models\Store', 'targetAttribute' => 'id']

            ];
        }


        public function upload()
        {
            if ($this->validate()) {
                $this->datafile->saveAs('uploads/' . $this->datafile->baseName . '.' . $this->datafile->extension);
                return true;
            } else {
                return false;
            }
        }


        public function createJob()
        {

        }

    }
