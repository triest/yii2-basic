<?php

    namespace app\jobs;

    use app\models\Title;
    use yii\base\BaseObject;

    class ImportJob extends BaseObject implements \yii\queue\Job
    {
        public $file;

        public $store_id;

        public function execute($queue)
        {
            $array_fields = [];
            $row = 1;
            if (($handle = fopen($this->file, "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $num = count($data);

                    if ($row == 1) { //считываем поля
                        echo "<p> Заголовки: <br /></p>\n";
                        for ($c = 0; $c < $num; $c++) {
                            echo $data[$c] . "<br />\n";
                            $array_fields[] = trim($data[$c]);
                        }
                        $row++;
                        continue;
                    }
                    var_dump($array_fields);
                    echo "<p> $num полей в строке $row: <br /></p>\n";
                  // $title = new Title();
                    $count = 0;
                    $title=new Title();
                    for ($c = 0; $c < $num; $c++) {
                        if($array_fields[$count]==""){
                            continue;
                        }
                        $fild_name=$array_fields[$count];
                        $title->$fild_name=$data[$c];
                        $count++;
                    }
                   $title->save(false);
                }
                fclose($handle);
            }

        }
    }