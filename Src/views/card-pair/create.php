<?php

use yii\helpers\Html;



$this->title = Yii::t('app', 'Create Card Pair');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Card Pairs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-pair-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
