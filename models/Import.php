<?php

    namespace app\models;

    use Yii;
    use yii\web\UploadedFile;

    /**
     * This is the model class for table "import".
     *
     * @property int $id
     * @property int|null $store_id
     * @property int|null $job_id
     * @property string|null $status
     * @property string|null $filename
     */
    class Import extends \yii\db\ActiveRecord
    {
        /**
         * {@inheritdoc}
         */
        public static function tableName()
        {
            return 'import';
        }

        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                    ['store_id', 'exist', 'targetClass' => '\app\models\Store', 'targetAttribute' => 'id'],
                    [['job_id'], 'integer'],
                    [['status', 'filename'], 'string', 'max' => 255],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                    'id' => 'ID',
                    'store_id' => 'Store ID',
                    'job_id' => 'Job ID',
                    'status' => 'Status',
            ];
        }

        public function upload(UploadedFile $file)
        {
            $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
            $file->saveAs(Yii::getAlias('@webroot') . '/uploads/' . $filename);
            $this->filename = $filename;
            $this->save(false);

            return $filename;
        }
    }
