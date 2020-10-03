<?

    use app\models\Import;
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\widgets\DetailView;
    use yii\widgets\LinkPager;
    use fedemotta\datatables\DataTables;

    $this->title = "Список импортов";
?>

<a href="/store/upload">
    <button class="btn btn-primary">Загрузить</button>
</a>


<?php
    $searchModel = new \app\models\ImportSeach();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                [
                        'attribute' => 'date',
                        'label' => 'Номер импорта',
                        'value' => function ($model, $key, $index, $column) {
                            return Html::label($model->id);
                        },
                        'format' => 'html'
                ],
                [
                        'attribute' => 'date',
                        'label' => 'Состояние',
                        'value' => function ($model, $key, $index, $column) {
                            return Html::label($model->status);
                        },
                        'format' => 'html'
                ],
                [
                        'attribute' => 'date',
                        'label' => 'Магазин',
                        'value' => function ($model, $key, $index, $column) {
                            return Html::label($model->getStore()->one()->title);
                        },
                        'format' => 'html'
                ],
                [
                        'attribute' => 'date',
                        'label' => 'Успешно импортированно',
                        'value' => function ($model, $key, $index, $column) {
                            return Html::label($model->success_count);
                        },
                        'format' => 'html'
                ],
                [
                        'attribute' => 'date',
                        'label' => 'Ошибочно  импортированно',
                        'value' => function ($model, $key, $index, $column) {
                            return Html::label($model->error_count);
                        },
                        'format' => 'html'
                ]


        ],
]); ?>

<? foreach ($imports as $item): ?>
    <div class="card-body">
        <b>Импорт<b></b> №<?= $item->id ?> <br>
            <b>Магазин</b> <?= $item->getStore()->one()->title ?>
            Импортированно:<?= $item->success_count ?>
            Ошибочных записей: <?= $item->error_count ?>
            Статус <?= $item->getStatus() ?>
    </div>
<? endforeach; ?>

<div class="card-footer text-muted">
    <?
        echo LinkPager::widget([
                'pagination' => $pages,
        ]);
    ?>
</div>
