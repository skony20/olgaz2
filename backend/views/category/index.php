<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategorie';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Nowa kategoria', ['value' => Url::to(['category/create']), 'title' => 'Nowa kategoria', 'class' => 'showModalButton btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'header' => 'Widoczna',
                'value'=> function ($data) {
                ($data->is_active == 1 ? $active="Widoczna" : $active="Niewidoczna");
                return $active;
            },
                
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
