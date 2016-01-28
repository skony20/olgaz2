<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Użytkownicy';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nowy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'firstname',
            'lastname',
//            'auth_key',
//            'password',
//            'password_reset_token',
            // 'email:email',
            // 'status',
             'created_at:datetime',
            // 'updated_at',
            // 'role_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);?>
</div>
