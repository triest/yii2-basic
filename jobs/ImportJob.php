<?php

    namespace app\jobs;

    use app\models\Import;
    use app\models\Title;
    use yii\base\BaseObject;

    class ImportJob extends BaseObject implements \yii\queue\Job
    {
        public $file;

        public $store_id;

        public $import_id;

        public function execute($queue)
        {
            $success_count = 0;
            $error_count = 0;
            $array_fields = [];
            $row = 1;
            if (($handle = fopen($this->file, "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $num = count($data);
                    if ($row == 1) { //считываем поля
                        for ($c = 0; $c < $num; $c++) {
                            echo $data[$c] . "<br />\n";
                            $array_fields[] = trim($data[$c]);
                        }
                        $row++;
                        continue;
                    }

                    $array_values = [];
                    for ($c = 0; $c < $num; $c++) {
                        if ($array_fields[$c] == "") {
                            continue;
                        }
                        $field_name = $array_fields[$c];
                        $array_values[$field_name] = $data[$c];
                    }


                    $position = array_search("upc", $array_fields);
                    if (is_int($position)) {  //проверяем, что знаяение есть в массиве
                        $find_title = Title::find()->where(["upc" => $array_values["upc"]])->one();
                        if ($find_title == null) {
                            $find_title = new Title();
                        }
                    } else {
                        continue;
                    }
                    foreach ($array_values as $key => $value) {
                            $find_title->$key = $value;
                    }

                    $find_title->save(false);
                }
                fclose($handle);
                $import = Import::find()->where(['id' => $this->import_id])->one();
                $import->success_count = $success_count;
                $import->error_count = $error_count;
                $import->save();
            }
        }
    }