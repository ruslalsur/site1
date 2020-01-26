<div class="row">
    <?php
    /** @var array $users */
    /** @var array $activities */
    echo \app\widgets\daoUserWidget\DaoUserWidget::widget(['user' => $users]);
    echo \app\widgets\daoUserWidget\DaoUserWidget::widget(['user' => $activities]);
    ?>

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

