<?php

namespace app\models;

use Yii;

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
class Users extends UsersBase
{
    public $password;

    public function rules()
    {
        return array_merge([
            ['password', 'required'],
            ['password', 'string', 'min' => 6]
        ], parent::rules());
    }
}
