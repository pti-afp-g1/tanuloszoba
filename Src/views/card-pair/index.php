<?php

use yii\helpers\Html;
use yii\grid\GridView;



$this->title = Yii::t('app', 'Card Pairs');
?>
<div class="card-pair-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Card Pair'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'card1',
                'value' => function ($data) {
                    return '/uploads/' . $data->card1;
                },
                'format' => ['image', ['width' => '125', 'height' => '175', 'class' => 'img-border']],
            ],
            [
                'attribute' => 'card2',
                'value' => function ($data) {
                    return '/uploads/' . $data->card2;
                },
                'format' => ['image', ['width' => '125', 'height' => '175', 'class' => 'img-border']],
            ],
            [
                'attribute' => 'Kategória',
                'value' => function ($data) {
                    return $data->category->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
