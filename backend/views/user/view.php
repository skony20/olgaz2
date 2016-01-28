<?php
use yii\base\Security;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Uzytkownicy', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-ms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edytuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Kasuj', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Jesteś pewien?',
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
            array(  
		    'label'=>'Hasło',
		    'value'=>'******'),
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
