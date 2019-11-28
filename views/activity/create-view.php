<?php $activeForm = \yii\bootstrap\ActiveForm::begin()?>
    <?=$activeForm->field($model, 'title');?>
    <?=$activeForm->field($model, 'description')->textarea();?>
    <?=$activeForm->field($model, 'dateStart')->input('date');?>
    <?=$activeForm->field($model, 'isBlocked')->checkbox();?>
    <div>
        <input  class="btn btn-danger" type="submit" value="Создать">
    </div>
<?php $activeForm = \yii\bootstrap\ActiveForm::end()?>

