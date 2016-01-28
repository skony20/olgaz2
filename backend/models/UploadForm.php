<?php
namespace app\models;

use yii\base\Model;
use yii\imagine\Image;
use Imagine\Image\Box;
use app\models\Post;

class UploadForm extends Model
{
    public $imageFiles;
    public $image;
    public $id;
    public $sFileName;
    public $sPath = '../../images/';
    public $sThumb = 'thumbs'; //80x80
    public $iThumbSize = 80;
    public $sInfo = 'info'; //300x300
    public $iInfoSize = 300;
    public $sBig = 'big'; //min 10224
    public $iBigSize = 1024;

    
    public function upload()
    {
            return false;
    }
    

    public function saveImages()
    {


        $this->CaMDir($this->id);
        $oPost = new Post();
        $aPost = $oPost->findOne($this->id);
        $sNiceName = $aPost['nice_link'];
        $sPath = $this->sPath.$this->id;
        //$files = $this->readDir($sPath);
       
        $files = $_FILES['attachment_'.$this->id.''];
        $sMaxFiles = count($files['name']);
        //echo '<pre> File2: ' . print_r($files, TRUE). '</pre>'; die();
        for ($a=0; $a<$sMaxFiles; $a++)
        {
            $sNumberFiles = $this->readDir($sPath.'/'.$this->sThumb);
            $iFileNumber = $sNumberFiles['max'];
            $sFileName = $sNiceName.'-'.$iFileNumber;
            $ext = substr($files['name'][$a], strrpos($files['name'][$a], '.') + 1);
            move_uploaded_file($files['tmp_name'][$a], $sPath.'/'.$sFileName.'.'.$ext);
            $this->resizeImage($sPath, $sFileName, $ext);
        }

        
        
        return TRUE;

    }
    public function readDir($sPath)
    {
        $oFiles = scandir($sPath);
        $aFiles = array_diff($oFiles, array('.','..'));
        if (!is_dir($sPath)) 
        {
            $aFiles = '';
        }
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
    public function resizeImage($sPath, $sFileName, $ext)
    {
        Image::frame($sPath.'/'.$sFileName . '.' . $ext, 0)->thumbnail(new Box($this->iThumbSize, $this->iThumbSize))->save($sPath.'/' .$this->sThumb.'/' .$sFileName . '.' . $ext, ['quality' => 100]);
        Image::frame($sPath.'/'.$sFileName . '.' . $ext, 0)->thumbnail(new Box($this->iInfoSize, $this->iInfoSize))->save($sPath.'/' .$this->sInfo.'/' .$sFileName . '.' . $ext, ['quality' => 100]);
        Image::frame($sPath.'/'.$sFileName . '.' . $ext, 0)->thumbnail(new Box($this->iBigSize, $this->iBigSize))->save($sPath.'/' .$this->sBig.'/' .$sFileName . '.' . $ext, ['quality' => 100]);
        unlink($sPath.'/'.$sFileName . '.' . $ext);
        
    }

}