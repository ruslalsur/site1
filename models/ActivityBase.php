<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $deadline
 * @property int $isBlocked
 * @property string|null $email
 * @property int $userNotification
 * @property string $createAt
 * @property int $user_id
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'deadline', 'user_id'], 'required'],
            [['description'], 'string'],
            [['deadline', 'createAt'], 'safe'],
            [['isBlocked', 'userNotification', 'user_id'], 'integer'],
            [['title', 'email'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'deadline' => Yii::t('app', 'Deadline'),
            'isBlocked' => Yii::t('app', 'Is Blocked'),
            'email' => Yii::t('app', 'Email'),
            'userNotification' => Yii::t('app', 'User Notification'),
            'createAt' => Yii::t('app', 'Create At'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}

