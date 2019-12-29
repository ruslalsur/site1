<?php


namespace app\controllers;


use app\models\Users;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionSignUp() {
        $model = new Users();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if (\Yii::$app->auth->signUp($model)) {
                return $this->redirect(['/auth/sign-in', 'id' => $model->id]);
            }
        }

        return $this->render('signup', ['model' => $model]);
    }

}