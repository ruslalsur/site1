<?php


namespace app\components;


use app\models\ActivityModel;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{
    public $classEntity;

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

    public function createActivity(ActivityModel &$model): bool
    {
        $model->file = UploadedFile::getInstance($model, 'file');

        if ($model->validate()) {
            if ($model->file) {
                if ($file = $this->saveFile($model->file)) {
                    $model->file = $file;
                }
            }

            return true;
        }
        return false;
    }

    private function saveFile(UploadedFile $file): ?string {
         if ($file->saveAs($this->genFilePath() . DIRECTORY_SEPARATOR . $this->genFileName($file))) {
             return $this->genFileName($file);
         }
         else  {
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

}