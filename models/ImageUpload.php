<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{

    public $image;

    public function rules()
    {
        return [
            [['image'], 'required' ],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public  function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;
        if($this->validate()) {

            $this->deleteCurrentImage($currentImage);

            $filename = $this->generateFilename();

            $file->saveAs($this->getFolder() . $filename);

            return $filename;
        }
    }

    public function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    public function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($currentImage)
    {
        if (file_exists($this->getFolder() . $currentImage) &&
            is_file($this->getFolder() . $currentImage)) {
            unlink($this->getFolder() . $currentImage);
        }
    }
}