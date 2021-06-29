<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

      <?
      foreach ($posts as $post) { ?>

          <div class="blog-post">
            <h2 class="blog-post-title"> <a href="/post/<?=$post->id ?>"> <?= $post->title ?></a></h2>
            <p class="blog-post-meta"><?= $post->getHumanDate() ?><a href="#"></a></p>

          </div>

      <?
      } ?>
