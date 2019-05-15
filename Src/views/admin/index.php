<?php

use yii\helpers\Html;
use yii\grid\GridView;



$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            [
                'attribute' => 'roleName',
                'value' => function ($data) {
                    return Yii::t('app', $data->roleName);
                },
                'filter' => [
                    'admin' => Yii::t('app', 'admin'),
                    'teacher' => Yii::t('app', 'teacher'),
                    'student' => Yii::t('app', 'student')
                ],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
