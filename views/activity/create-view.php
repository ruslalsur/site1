<h1>Create view</h1>
<?php $activeForm = \yii\bootstrap\ActiveForm::begin() ?>
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
    <input class="btn btn-danger" type="submit" value="Создать">
</div>
<?php $activeForm = \yii\bootstrap\ActiveForm::end() ?>

