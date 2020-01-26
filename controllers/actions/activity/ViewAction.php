<?php


namespace app\controllers\actions\activity;


use app\behaviors\DateCreateBehavior;
use app\models\ActivityModel;
use yii\base\Action;
use yii\web\HttpException;

class ViewAction extends Action
{
    public function run($id) {
        \Yii::$app->logIt();
        $model = ActivityModel::find()->andWhere(['id'=>$id])->one();

        if(!$model) {
            throw new HttpException(404, 'Activity not found');
        }

        //подключение поведения динамически
//        $model->attachBehavior('creatAt', ['class'=>DateCreateBehavior::class, 'attributeName'=>'createAt']);
//        $model->detachBehavior('createAt');

        if (!\Yii::$app->rbac->canEditActivity($model)) {
            throw new HttpException(404, 'activity not for you');
        }

        return $this->controller->render('view', ['model'=>$model]);
    }

}