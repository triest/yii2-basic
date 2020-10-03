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
     * @property int|null $success_count
     * @property int|null $error_count
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
                    [['store_id', 'job_id', 'success_count', 'error_count'], 'integer'],
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
                    'filename' => 'Filename',
                    'success_count' => 'Success Count',
                    'error_count' => 'Error Count',
            ];
        }

        public function upload(UploadedFile $file)
        {
            $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
            $folder = Yii::getAlias('@webroot') . '/uploads/' . $this->store_id;
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $file->saveAs($folder . '/' . $filename);
            $this->filename = $filename;
            $this->save(false);
            return $filename;
        }

        /**
         * Gets query for [[Titles]].
         *
         * @return \yii\db\ActiveQuery
         */
        public function getStore()
        {
            return $this->hasOne(Store::className(), ['id' => 'store_id']);
        }

        public function getStatus()
        {

            if (Yii::$app->queue->isWaiting($this->job_id)) {
                return "Ожидаетть запуск";
            }
            if (Yii::$app->queue->isReserved($this->job_id)) {
                return "Выполняеться";
            }

            if (Yii::$app->queue->isDone($this->job_id)) {
                return "Выполнено";
            }

            return null;
        }

    }
