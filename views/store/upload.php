<?php
    use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $this->render('_form', [
        'model' => $model,'stores'=>$stores
]) ?>

<button>Submit</button>

<?php ActiveForm::end() ?>
