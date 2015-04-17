<?php

Yii::import('xupload.actions.XUploadAction');

class MediaUploadAction extends XUploadAction
{
    public $modelUploadId = 0;
    public $modelUploadName = '';
    public $modelUploadDetail = '';
    public $folder = '';
    public $thumbKey = '';
    public $thumbDefault = '';

    public function init()
    {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
            chmod($this->path, 0777);
        } else if (!is_writable($this->path)) {
            chmod($this->path, 0777);
        }

        if (!isset($this->_formModel)) {
            $this->formModel = Yii::createComponent(array('class' => $this->formClass));
        }

        if ($this->secureFileNames) {
            $this->formModel->secureFileNames = true;
        }
    }

    protected function beforeReturn()
    {
        // Save the uploaded picture into db
        $model = new $this->modelUploadDetail();
        $model->name = $this->formModel->{$this->displayNameAttribute};
        $model->source = $this->formModel->{$this->fileNameAttribute};
        $model->{$this->modelUploadName} = $this->modelUploadId;
        $sql = "SELECT id 
                FROM " . $model->tableName() . " 
                WHERE is_featured =  " . TYPE_YES  . " AND " . $this->modelUploadName . " = " . $this->modelUploadId;
        $rawData = Yii::app()->db->createCommand($sql)->queryAll();
        if (count($rawData) == 0) {
            $model->is_featured = 1;
        } else {
            $model->is_featured = 0;
        }
        $model->save(false);
        return $model;
    }

    protected function handleUploading()
    {
        $this->init();
        $model = $this->formModel;
        $model->{$this->fileAttribute} = CUploadedFile::getInstance($model, $this->fileAttribute);
        if ($model->{$this->fileAttribute} !== null) {
            $model->{$this->mimeTypeAttribute} = $model->{$this->fileAttribute}->getType();
            $model->{$this->sizeAttribute} = $model->{$this->fileAttribute}->getSize();
            $model->{$this->displayNameAttribute} = $model->{$this->fileAttribute}->getName();
            $model->{$this->fileNameAttribute} = $model->{$this->displayNameAttribute};

            if ($model->validate()) {
                $path = $this->getPath();

                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                    chmod($path, 0777);
                }

                $model->{$this->fileAttribute}->saveAs($path . $model->{$this->fileNameAttribute});
                chmod($path . $model->{$this->fileNameAttribute}, 0777);

                // Create thumbs
                if (!empty($this->thumbKey))
                    Utils::createThumbFiles($model->{$this->fileNameAttribute}, $path, $this->thumbKey, false);

                $returnValue = $this->beforeReturn();
                if ($returnValue) {
                    $thumbConfigs = Yii::app()->params['thumb'][$this->thumbKey];
                    echo json_encode(array(array(
                        "id" => $returnValue->{$this->modelUploadName},
                        "idImg" => $returnValue->id,
                        "is_featured" => $returnValue->is_featured,
                        "name" => $model->{$this->displayNameAttribute},
                        "url" => $this->getFileUrl($model->{$this->fileNameAttribute}),
                        "thumbnail_url" => $this->getPublicPath() . $this->thumbDefault . '/' . $model->{$this->fileNameAttribute},
                        "no_thumbnail_url" => $this->getPublicPath() . $model->{$this->fileNameAttribute}
                    )));
                } else {
                    echo json_encode(array(array("error" => $returnValue->id,)));
                    Yii::log("XUploadAction: " . $returnValue->id, CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction");
                }
            } else {
                echo json_encode(array(array("error" => $model->getErrors($this->fileAttribute),)));
                Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction");
            }
        } else {
            throw new CHttpException(500, "Could not upload file");
        }
    }
}