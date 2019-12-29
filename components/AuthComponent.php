<?php


namespace app\components;


use app\models\Users;
use yii\base\Component;
use yii\web\IdentityInterface;

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

    /**
     * @param IdentityInterface |Users $model
     * @return bool
     */
    public function signIn(IdentityInterface &$model) {
        if (!$model->validate(['email', 'password'])) {
            return false;
        }

        $userIdentity = $this->getUserByEmail($model->email);
        if (!$this->validatePassword($model->password, $userIdentity->password_hash)) {
            $model->addError('password', 'ошибка логина или пароля');
            return false;
        };

        return \Yii::$app->user->login($userIdentity, 3600);

    }

    private function getUserByEmail($email): Users {
        return Users::find()->andWhere(['email'=>$email])->one();
    }

    private function validatePassword($password, $passwordHash): bool {
        return \Yii::$app->security->validatePassword($password, $passwordHash);
    }

}