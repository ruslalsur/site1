<div class="row">
    <?php
    /** @var array $users */
    /** @var array $activities */
    /** @var \yii\web\View $this */
?>
    <?php if ($this->beginCache('widget_list', ['duration'=> 30])): ?>
    <?php echo \app\widgets\daoUserWidget\DaoUserWidget::widget(['user' => $users]); ?>
    <?php echo \app\widgets\daoUserWidget\DaoUserWidget::widget(['user' => $activities]); ?>
    <?php $this->endCache(); endif?>

    <div class="col-md-6">
        <pre>
            <?php
            print_r($act1);
            ?>
        </pre>
    </div>

    <div class="col-md-6">
        <pre>
            <?php
            print_r($scalar);
            ?>
        </pre>
    </div>

    <div class="col-md-6">
        <pre>
            <?php
            foreach ($reader as $value) {
                print_r($value);
            }
            ?>
        </pre>
    </div>
</div>

