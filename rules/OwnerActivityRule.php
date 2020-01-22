<?php


namespace app\rules;


use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Rule;
use yii\web\HttpException;

class OwnerActivityRule extends Rule
{
    public $name = 'ownerActivityRule';

    /**
     * @inheritDoc
     */
    public function execute($user, $item, $params)
    {
        $activity = ArrayHelper::getValue($params, 'activity');
        if (!$activity) {
            throw new \Exception('need param in rule');
        }
        return $user == $activity->user_id;
    }
}