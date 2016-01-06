<?php
namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $imageFiles;
    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 20],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file->saveAs('c:/xampp/htdocs/olgaz2/images/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function validate()
    {

        return TRUE;
    }
}