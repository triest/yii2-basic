<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

  <div class="jumbotron">
    <a class="btn btn-primary" href="post/create"></a>
  </div>

  <div class="body-content">
      <?
      foreach ($posts as $post) { ?>

          <div class="blog-post">
            <h2 class="blog-post-title"> <?= $post->title ?></h2>
            <p class="blog-post-meta"><?= $post->getHumanDate() ?><a href="#"></a></p>

          </div>

      <?
      } ?>
  </div>
</div>
