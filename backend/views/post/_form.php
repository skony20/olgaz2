<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\ArrayHelp;
use app\models\Category;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => 'create-post-form'
                ]]); ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'advance'
    ]) ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>\Yii::$app->user->identity->id])->label(false); ?>
    <?= $form->field($model, 'data_creation')->hiddenInput(['value'=>($model->data_creation != '' ? $model->data_creation : time())])->label(false); ?>
    <?= $form->field($model, 'last_modification')->hiddenInput(['value'=> time()])->label(false); ?>
    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name'), array('prompt'=>'Wybierz kategorię')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
