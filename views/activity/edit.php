<h1>Edit activity</h1>
<?php

use yii\bootstrap\ActiveForm;

$activeForm = ActiveForm::begin()
?>
<?= $activeForm->field($model, 'title'); ?>
<?= $activeForm->field($model, 'description')->textarea(); ?>
<?= $activeForm->field($model, 'deadline')->input('text'); ?>
<?= $activeForm->field($model, 'isBlocked')->checkbox(); ?>
<?= $activeForm->field($model, 'email', ['enableAjaxValidation' => true, 'enableClientValidation' => false]); ?>
<?= $activeForm->field($model, 'userNotification')->checkbox(); ?>
<?= $activeForm->field($model, 'emailRepeat'); ?>
<?= $activeForm->field($model, 'iteratorType')->dropDownList($model::REPEAT_TYPE); ?>
<?= $activeForm->field($model, 'files[]')->fileInput(['multiple' => true]); ?>
<div>
    <input class="btn btn-danger" type="submit" value="Изменить">
</div>
<?php ActiveForm::end() ?>

