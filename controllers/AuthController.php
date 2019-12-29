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
            $model->setScenarioSignUp();

            if (\Yii::$app->auth->signUp($model)) {
                return $this->redirect(['/auth/sign-in', 'id' => $model->id]);
            }
        }

        return $this->render('signup', ['model' => $model]);
    }

    public function actionSignIn() {
        $model = new Users();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->setScenarioSignIn();

            if (\Yii::$app->auth->signIn($model)) {
                return $this->redirect(['/activity/create']);
            }
        }

        return $this->render('signin', ['model' => $model]);
    }

}