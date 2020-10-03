<?php

    namespace app\jobs;

    use app\models\Import;
    use app\models\Title;
    use app\parsers\csvParser;
    use yii\base\BaseObject;

    class ImportJob extends BaseObject implements \yii\queue\Job
    {
        public $file;

        public $store_id;

        public $import_id;

        private $parsers = [
                "csv" => csvParser::class
        ];

        public function execute($queue)
        {
            $ext = pathinfo($this->file, PATHINFO_EXTENSION);
            if ($ext == null) {
                $import = Import::find()->where(['id' => $this->import_id])->one();
                if ($import != null) {
                    $import->errors="error file extension";
                }
                return;
            }
            $class = $this->parsers[$ext];
            if ($class == null) {
                $import = Import::find()->where(['id' => $this->import_id])->one();
                if ($import != null) {
                    $import->errors="parse class not found";
                }
                return;
            }
            $class = new $class($this->file, $this->import_id);
            if ($class == null) {
                $import = Import::find()->where(['id' => $this->import_id])->one();
                if ($import != null) {
                    $import->errors = "class instants not found";
                }
                return;
            }
            $class->parse();
        }
    }