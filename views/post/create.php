<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

  <form action="/post/create" method="post">
      <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

      <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

      <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

      <?php ActiveForm::end(); ?>

  </form>

</div>
