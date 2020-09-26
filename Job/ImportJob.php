<?php

    namespace frontend\jobs;

    use yii\base\Object;

    class ImportJob extends Object implements \yii\queue\Job
    {
        public $file;

        public function execute($queue)
        {
            file_put_contents($this->file, $this->text);
        }
    }