<!DOCTYPE html>

<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\SignupForm $signupFormModel */

$this->title = 'SignUp';
?>

<?php $form = ActiveForm::begin() ?>

<?= $form->field($signupFormModel, 'username') ?>

<?= $form->field($signupFormModel, 'password')->passwordInput() ?>

<div class="form-group">
    <div>
        <?= Html::submitButton('Register', ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>