<div class="row">
    <div class="col">
        <h2>Авторизация</h2>
        <?php $form = \yii\bootstrap\ActiveForm::begin() ?>
        <?=$form->field($model, 'email') ?>
        <?=$form->field($model, 'password')->passwordInput()?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Авторизация</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end() ?>
    </div>
</div>
