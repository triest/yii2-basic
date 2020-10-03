<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;

?>
    <div class="girls-form">

        <form action="<?= Url::toRoute(['anket/create']) ?>" method="post" enctype="multipart/form-data">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'datafile')->fileInput() ?>
            <?= $form->field($model, 'store_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map($stores, 'id', 'title')) ?>
            <br>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </form>

    </div>
