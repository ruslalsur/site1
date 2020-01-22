<?php


namespace app\controllers\actions\activity;


use app\models\ActivityModel;
use yii\base\Action;
use yii\web\HttpException;

class ViewAction extends Action
{
    public function run($id) {
        $model = ActivityModel::find()->andWhere(['id'=>$id])->one();

        if(!$model) {
            throw new HttpException(404, 'Activity not found');
        }

        if (!\Yii::$app->rbac->canEditActivity($model)) {
            throw new HttpException(404, 'activity not for you');
        }

        return $this->controller->render('view', ['model'=>$model]);
    }

}