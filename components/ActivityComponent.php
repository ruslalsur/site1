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
        $model->files = UploadedFile::getInstances($model, 'files');

        if ($model->validate()) {
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
}