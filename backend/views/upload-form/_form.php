<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>
<?php
use yii\widgets\ActiveForm;
use app\models\UploadForm;
$model = new UploadForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],  'id' => 'AddPostImages']) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>