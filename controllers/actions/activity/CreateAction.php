<?php


namespace app\controllers\actions\activity;


use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class CreateAction extends Action
{
    public $classEntity;

    public function run()
    {
        if (!\Yii::$app->rbac->canCreateActivity()) {
            return $this->controller->redirect(['/auth/sign-in']);
//            throw new HttpException('403', 'не авторизовано');
        }

        //создание компонента статически(по зарегистрированному в config/web)
        $activityModel = \Yii::$app->activityComp->getEntity();
        $tableDb = \Yii::$app->activityComp->getNameTableDb();

//        //создание компонента динамически
//        $activityComponent = \Yii::createObject(['class' => ActivityComponent::class,
//            'classEntity' => ActivityModel::class]);
//        $activityModel = $activityComponent->getEntity();

        //загрузка данных в модель
        $activityModel->title = 'Заголовок из CreateAction';

        if (\Yii::$app->request->isPost) {
            //множественная загрузка
            $activityModel->load(\Yii::$app->request->post());

            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($activityModel);
            }

            //обращение к статически созданному компаненту
            if (\Yii::$app->activityComp->createActivity($activityModel)) {
//                \Yii::$app->dao->insertActivityIntoDb($activityModel, $tableDb);

                return $this->controller->redirect(['/activity/view', 'id' => $activityModel->id]);

//            //обращение к динамически созданному компаненту
//            if ($activityComponent->createActivity($activityModel)) {

                return $this->controller->renderPartial('info-view', ['model' => $activityModel]);
            }
        }
        return $this->controller->render('create-view', ['model' => $activityModel]);
    }
}