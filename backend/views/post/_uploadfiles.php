<?php

use yii\helpers\Url;
use kartik\file\FileInput;
use app\models\UploadForm;
/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
$oUploadForm = new UploadForm();
$iPostValue = $_GET['id'];
?>

<div class="post-form">
<div class="add_picture">
                        <?php
                        echo FileInput::widget([
                            'model' => $oUploadForm,
                            'name' => 'attachment_'.$iPostValue.'[]',
                            'language' => 'pl',
                            'options' => ['multiple' => true],
                            
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['upload-form/upload?id='.$iPostValue.'']),
                                'uploadAsync' => false,
                                'showRemove' => false, 
                                'allowedFileTypes' => array('image'),
                                ]
                        ]);
                            ?>
                    </div>
</div>
