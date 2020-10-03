<?php
    use yii\widgets\ActiveForm;
    $this->title = "Загрузка файла";
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $this->render('_form', [
        'model' => $model,'stores'=>$stores
]) ?>
<a href="/store"><button class="btn btn-primary">Назад</button> </a>
<?php ActiveForm::end() ?>
