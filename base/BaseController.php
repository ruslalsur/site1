<?php


namespace app\base;


use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        \Yii::warning($action->id);
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['/auth/sign-in']);
//            throw new HttpException('401', 'авторизуйтесь');
        }
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('prev_page', \Yii::$app->request->absoluteUrl);

        return parent::afterAction($action, $result);
    }


}