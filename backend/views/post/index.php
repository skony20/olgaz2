<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wpisy';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Nowy wpis', ['value' => Url::to(['post/create']), 'title' => 'Nowy wpis', 'class' => 'showModalButton btn btn-success']); ?>
    </p>

    <?php 
    $dataProvider->pagination->pageSize=15; 

    
    ?>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        [
            'label' =>'Data',
            'value' =>'data_creation',
            'format' => 'date',
            'contentOptions' => ['class' => 'editor'],
        ],
        [
            'label' =>'Aktywny',
            'format' => 'html',
            'value' => function ($data) {
                $sActive = Html::tag('div', '', ['class' => 'glyphicon glyphicon-stop status_icon activePost', 'title' => 'Wyłącz wpis']);     
                $sUnActive = Html::tag('div', '', ['class' => 'glyphicon glyphicon-stop status_icon unactivePost', 'title' => 'Włącz wpis']);
                $button = ($data->is_active == 1 ? $sActive : $sUnActive);
                return $button ; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            'contentOptions' => ['class' => 'text-center']
        ]
    ],
    
]) ?>
    
<?php
$dataProvider = new ActiveDataProvider([
    'pagination' => [
	    'pagesize' => 10,
    ],
]);
?>
</div>