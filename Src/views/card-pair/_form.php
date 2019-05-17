<?php

use app\assets\UploadAsset;
use app\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


UploadAsset::register($this);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="upload-form" data-input-id="#cardpair-card1" action="/card-pair/upload" method="post" enctype="multipart/form-data">
                <input class="upload-image" type="file" accept="image/*" name="image"/>
                <div class="preview"><img src="/images/filed.png"/></div>
                <br>
                <input class="btn btn-success" type="submit" value="Feltölt">
            </form>
            <div class="err"></div>
        </div>
        <div class="col-md-6">
            <form class="upload-form" data-input-id="#cardpair-card2"  action="/card-pair/upload" method="post" enctype="multipart/form-data">
                <input class="upload-image" type="file" accept="image/*" name="image"/>
                <div class="preview"><img src="/images/filed.png"/></div>
                <br>
                <input class="btn btn-success" type="submit" value="Feltölt">
            </form>
            <div class="err"></div>
        </div>
    </div>
</div>

<div class="card-pair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'card1')->textInput(['maxlength' => true, 'style' => 'display: none;'])->label(false) ?>

    <?= $form->field($model, 'card2')->textInput(['maxlength' => true, 'style' => 'display: none;'])->label(false) ?>

    <?= $form->field($model, 'afp2_category_id')->dropDownList(
        ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title'),
        ['prompt' => '-- Válasszon kategóriát --']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Rögzít'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
