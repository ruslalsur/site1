<?php


namespace app\commands;


use app\models\ActivityModel;
use yii\console\Controller;
use yii\mail\MailerInterface;

class NotificationController extends Controller
{
    public $name;

    /** @var MailerInterface */
    public $mailer;

    public function options($actionID)
    {
        return [
            'name'
        ];
    }

    public function optionAliases()
    {
        return [
            'n' => 'name'
        ];
    }

    public function actionTest()
    {
        echo 'параметр с именем --name или -n содержит значение ' . $this->name . PHP_EOL;
    }

    public function actionSendToday()
    {
        $this->mailer = \Yii::$app->mailer;
        $activities = \Yii::$app->activityComp->getActiveActivityTodayNotification();
        echo count($activities) . PHP_EOL;

        $this->sendNotificationToActivity($activities);
    }

    private function sendNotificationToActivity(array $activities)
    {
        /** @var ActivityModel $activity */
        foreach ($activities as $activity) {
            $ok = $this->mailer->compose('notification', ['model'=>$activity])->
                setSubject('письмо про событие')->
                setFrom('rusla.sukhorukov@yandex.ru')->
                setTo($activity->email)->
                send();

            if ($ok) {
                echo 'отправлено ' . $activity->email . PHP_EOL;
            } else {
                echo 'не отправлено ' . $activity->email . PHP_EOL;
            }
        }
    }
}