<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CardPair */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Card Pairs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card-pair-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'card1',
                'value' => '/uploads/' . $model->card1,
                'format' => ['image', ['width' => '125', 'height' => '175', 'class' => 'img-border']],
            ],
            [
                'attribute' => 'card2',
                'value' => '/uploads/' . $model->card2,
                'format' => ['image', ['width' => '125', 'height' => '175', 'class' => 'img-border']],
            ],
            [
                'attribute' => 'Kategória',
                'value' => function ($data) {
                    return $data->category->title;
                }
            ],
        ],
    ]) ?>

</div>
