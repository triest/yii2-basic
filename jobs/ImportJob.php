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
                return;
            }
            $class = $this->parsers[$ext];
            if ($class == null) {
                return;
            }
            $class = new $class($this->file, $this->import_id);
            if ($class == null) {
                return;
            }
            $class->parse();
        }
    }