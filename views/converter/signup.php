<!DOCTYPE html>

<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>