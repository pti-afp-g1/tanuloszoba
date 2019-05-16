<?php
/* @var $this yii\web\View */
/* @var $dataProvider1 */

/* @var $dataProvider2 */

use yii\grid\GridView; ?>
<h1>Dicsőségfal</h1>

<p>
    Avagy a legjobb eredmények listái
</p>

<div class="row">
    <div class="col-md-6">
        <h3>Kártyapárosítás</h3>
        <?= GridView::widget([
            'dataProvider' => $dataProvider1,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user',
                    'value' => function ($data) {
                        return $data->user->username;
                    }
                ],
                'resolved',
                'error'
            ],
        ]); ?>
    </div>
    <div class="col-md-6">
        <h3>Memóriajáték</h3>
        <?= GridView::widget([
            'dataProvider' => $dataProvider2,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user',
                    'value' => function ($data) {
                        return $data->user->username;
                    }
                ],
                'resolved'
            ],
        ]); ?>
    </div>
</div>
