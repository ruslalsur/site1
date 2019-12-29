<?php


namespace app\components;


use app\models\Users;
use yii\base\Component;

class AuthComponent extends Component
{
    public function signUp(Users &$model): bool
    {
        if (!$model->validate(['email', 'password'])) {
            return false;
        }

        $model->password_hash = $this->genPasswordHash($model->password);
        $model->auth_key = $this->genAuthKey();

        return $model->save() ? true : false;
    }

    private function genPasswordHash(string $password): string
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }

    private function genAuthKey(): string {
        return \Yii::$app->security->generateRandomString();
    }

}