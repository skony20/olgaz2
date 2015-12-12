<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

      <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => 'create-category-form'
                ]]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'is_active')-> checkbox ($options = ['Tak'=>'1', 'Nie'=>'0']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Aktualizuj', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

    <?php ActiveForm::end(); ?>

</div>
