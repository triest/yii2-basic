<?

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

?>
<? foreach ($imports as $item): ?>
    <div class="card-body">
        <b>Импорт<b></b> №<?= $item->id ?> <br>
            <b>Магазин</b> <?= $item->getStore()->one()->title ?>
            Импортированно:<?= $item->success_count ?>
            Ошибочных записей: <?= $item->error_count ?>
            Статус <?=$item->getStatus() ?>
    </div>
    <div class="card-footer text-muted">

    </div>
<? endforeach; ?>


