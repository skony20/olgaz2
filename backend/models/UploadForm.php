<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\imagine\Image;
use Imagine\Image\Box;

class UploadForm extends Model
{
    public $imageFiles;
    public $image;
    public $id;
    public $sPath = '../../images/';
    public $sThumb = 'thumbs'; //80x80
    public $iThumbSize = 80;
    public $sInfo = 'info'; //300x300
    public $iInfoSize = 300;
    public $sBig = 'big'; //min 10224
    public $iBigSize = 1024;

    
    public function upload()
    {
        
        if ($this->validate()) { 
            
            foreach ($this->image as $file) {
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
    public function saveImages()
    {
        
        $sPath = $this->sPath.$this->id;
        //$files = $this->readDir($sPath);
        
        $this->CaMDir($this->id);
                
        $file = $this->image;
        $file->saveAs($sPath.'/' .$file->baseName . '.' . $file->extension);
        $this->resizeImage($sPath, $file);
        return TRUE;

    }
    public function readDir($sPath)
    {
        $oFiles = scandir($sPath);
        $aFiles = array_diff($oFiles, array('.','..'));
        return array('files'=>$aFiles, 'max' => count($aFiles));
    }
    public function CaMDir($id)
    {
        //check and make dir with subdir
        $sPath = $this->sPath.$id;
        if (!is_dir($sPath)) 
        {
            //@mkdir($sPath, 0777, TRUE); 
            @mkdir($sPath.'/'.$this->sThumb, 0777, TRUE); 
            @mkdir($sPath.'/'.$this->sInfo, 0777, TRUE); 
            @mkdir($sPath.'/'.$this->sBig, 0777, TRUE); 
        }
        return TRUE;
    }
    public function resizeImage($sPath, $file)
    {
        Image::frame($sPath.'/'.$file->baseName . '.' . $file->extension)->thumbnail(new Box($this->iThumbSize, $this->iThumbSize))->save($sPath.'/' .$this->sThumb.'/' .$file->baseName . '.' . $file->extension, ['quality' => 100]);
        Image::frame($sPath.'/'.$file->baseName . '.' . $file->extension)->thumbnail(new Box($this->iInfoSize, $this->iInfoSize))->save($sPath.'/' .$this->sInfo.'/' .$file->baseName . '.' . $file->extension, ['quality' => 100]);
        Image::frame($sPath.'/'.$file->baseName . '.' . $file->extension)->thumbnail(new Box($this->iBigSize, $this->iBigSize))->save($sPath.'/' .$this->sBig.'/' .$file->baseName . '.' . $file->extension, ['quality' => 100]);
        
    }
}


//Dopisac skalowaie picturów i subfoldery dorobić 