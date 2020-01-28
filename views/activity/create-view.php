<?php

use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

?>

<h1><?=Yii::t('app', 'Create view'); ?></h1>

<?php $activeForm = ActiveForm::begin([]); ?>
<?= $activeForm->field($model, 'title'); ?>
<?= $activeForm->field($model, 'description')->textarea(); ?>
<?= $activeForm->field($model, 'deadline')->widget(MaskedInput::class, ['mask' => '9999-99-99']); ?>
<?= $activeForm->field($model, 'isBlocked')->checkbox(); ?>
<?= $activeForm->field($model, 'email', ['enableAjaxValidation' => true, 'enableClientValidation' => false]); ?>
<?= $activeForm->field($model, 'userNotification')->checkbox(); ?>
<?= $activeForm->field($model, 'emailRepeat'); ?>
<?= $activeForm->field($model, 'iteratorType')->dropDownList($model::REPEAT_TYPE); ?>
<?= $activeForm->field($model, 'files[]')->fileInput(['multiple' => true]); ?>
<div>
    <input class="btn btn-danger" type="submit" value="Создать">
</div>
<?php ActiveForm::end() ?>

