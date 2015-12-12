<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Ms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-ms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            array(  
		    'label'=>'Utworzony',
		    'value'=>date('Y-m-d H:i:s',$model->created_at)),
            array(  
		    'label'=>'Ostatnia mdyfikacja',
		    'value'=>date('Y-m-d H:i:s',$model->updated_at)),
            'role_id',
        ],
    ]) ?>

</div>
