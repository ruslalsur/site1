<h1>Активность №<?= $model->id ?></h1>
<h2><?= Yii::t('app', 'Title activity', ['name' => $model->title]) ?></h2>
<p>Описание <?= $model->description ?></p>
<p>
    Создал:
    <?= $model->user->email ?>&nbsp;
    <?= Yii::t('app', 'Deadline',[strtotime($model->deadline)]); ?>
</p>


