<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string|null $token
 * @property string|null $auth_key
 * @property string $createAt
 *
 * @property Activity[] $activities
 */
class Users extends UsersBase implements IdentityInterface
{
    public $password;
    const SCENARIO_SIGNUP = 'signup';
    const SCENARIO_SIGNIN = 'signin';

    public function setScenarioSignUp(): self {
        $this->setScenario(self::SCENARIO_SIGNUP);
        return $this;
    }

    public function setScenarioSignIn(): self {
        $this->setScenario(self::SCENARIO_SIGNIN);
        return $this;
    }

    public function scenarios()
    {
        return array_merge([
            self::SCENARIO_SIGNUP => ['email','password'],
            self::SCENARIO_SIGNIN => ['email','password'],
        ],parent::scenarios());
    }

    public function rules()
    {
        return array_merge([
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['email'], 'unique', 'on' => self::SCENARIO_SIGNUP],
            [['email'], 'exist', 'on' => self::SCENARIO_SIGNIN]
        ], parent::rules());
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return Users::find()->cache(20)->andWhere(['id'=>$id])->one();
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
}
