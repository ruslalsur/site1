<?php


namespace app\components;


use app\behaviors\LogBehavior;
use app\models\ActivityModel;
use phpDocumentor\Reflection\Types\Boolean;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{
    public $classEntity;
    const EVENT_CUSTOM = 'custom_event';

    public function behaviors()
    {
        return [
            LogBehavior::class
        ];
    }


    public function init()
    {
        parent::init();
        if (empty($this->classEntity)) {
            throw new \Exception('callsEntity param required');
        }
    }

    public function getEntity()
    {
        return new $this->classEntity();
    }

    /**
     * @param $id
     * @return ActivityModel|null
     */
    public function getActivityById($id): ?ActivityModel
    {
        return ActivityModel::find()->andWhere(['id' => $id])->one();
    }

    public function editActivity(ActivityModel &$activity): bool
    {
        if (!$activity->validate()) {
            return false;
        }
        return $activity->save();
//        $activity->updateAttributes(['title', 'description']);
//        return true;
    }

    public function createActivity(ActivityModel &$model): bool
    {
        $model->files = UploadedFile::getInstances($model, 'files');
        $model->user_id = \Yii::$app->user->getId();

        if ($model->save()) {
            $this->trigger(self::EVENT_CUSTOM);
            if ($model->files) {
                foreach ($model->files as $fileIndex => $file) {
                    if ($file = $this->saveFile($file)) {
                        $model->files[$fileIndex] = $file;
                    }
                }
            }
            return true;
        }
        return false;
    }

    private function saveFile(UploadedFile $file): ?string
    {
        $path = $this->genFilePath();
        $fileName = $this->genFileName($file);
        $path .= DIRECTORY_SEPARATOR . $fileName;

        if ($file->saveAs($path)) {
            return $fileName;
        } else {
            return null;
        }
    }

    private function genFilePath(): string
    {
        $filePath = \Yii::getAlias('@webroot/images');
        FileHelper::createDirectory($filePath);
        return $filePath;
    }

    private function genFileName(UploadedFile $file)
    {
        return time() . '_' . $file->getBaseName() . '_' . $file->getExtension();
    }

    function getNameTableDb()
    {
        return 'activity';
    }

    /**
     * @return ActivityModel [] | null
     */
    public function getActiveActivityTodayNotification(): array
    {
        $result = ActivityModel::find()->
        andWhere('deadline<=:date', [':date' => date('Y-m-d')])->
        andWhere(['userNotification' => 1])->
        all();

        return $result;
    }
}