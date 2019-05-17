<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Regisztráció';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'layout' => 'horizontal',
        'options' => ['autocomplete' => 'off'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'new-username']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'autocomplete' => 'new-password']) ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Regisztrálok', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
