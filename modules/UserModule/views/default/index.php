<div class="user-default-index">
    <?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

   $form = ActiveForm::begin([
                                                        'id' => 'login-form',
                                                        'layout' => 'horizontal',
                                                        'fieldConfig' => [
                                                                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                                                        ],
                                                ]); ?>



as

    <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

  <div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
  </div>



    <?php ActiveForm::end(); ?>

</div>
