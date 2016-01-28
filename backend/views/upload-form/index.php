<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'UploadForm';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
use yii\widgets\ActiveForm;
use app\models\UploadForm;
$model = new UploadForm();
?>
<?php
echo FileInput::widget([
    'model' => $model,
    'attribute' => 'image',
    'name' => 'attachment[]',
    'options' => [
        'multiple' => true,
        'accept' => 'image/*'
    ],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['upload-form/upload?id=8']),
        'uploadExtraData' => [
            'album_id' => 20,
            'cat_id' => 'Nature'
        ],
        'maxFileCount' => 10
    ]
]);