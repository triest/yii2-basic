<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */


use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->title = $post->title;
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="main-content" class="blog-page">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 left-box">
                <div class="card single_post">
                    <div class="body">
                        <div class="img-post">
                            <img class="d-block img-fluid" src="<?="/uploads/".$post->main_image?> " alt="First slide" width="400px">

                        </div>
                        <h3><?=$post->title ?></h3>
                        <p><?=$post->description ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2>Comments 3</h2>
                    </div>
                    <div class="body">
                        <ul class="comment-reply list-unstyled">
                           <? foreach ($post->getComments()->orderBy('create_at','desc')->all() as $comment){ ?>
                            <li class="row clearfix">
                                <div class="icon-box col-md-2 col-4"><img class="img-fluid img-thumbnail" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Awesome Image"></div>
                                <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                    <h5 class="m-b-0"><?=$comment->getUser()->one()->username ?></h5>
                                    <p><?=$comment->text ?></p>
                                    <ul class="list-inline">
                                        <li><a href="javascript:void(0);"><?=$comment->getHumanDate() ?></a></li>
                                    </ul>
                                </div>
                            </li>
                          <? } ?>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2>Leave a reply <small>Your email address will not be published. Required fields are marked*</small></h2>
                    </div>
                    <div class="body">
                        <div class="comment-form">
                            <form class="row clearfix" action="/comment/send" method="post">
                                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                                <?= $form->field($commentForm, 'user_name')->textInput(['autofocus' => true]) ?>

                                <?= $form->field($commentForm, 'description') ?>

                              <?=   $form->field($commentForm, 'post_id')->hiddenInput(['value'=> $post->id])->label(false);  ?>


                              <button>Submit</button>

                                <?php ActiveForm::end() ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
