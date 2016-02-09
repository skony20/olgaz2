<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
 
    

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Wpisy', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
         <?= Html::button('Aktualizuj', ['value' => Url::to(['post/update?id='.$model->id]), 'title' => 'Aktualizuj wpis', 'class' => 'showModalButton btn btn-success']); ?>
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
            'title',
            'content:ntext',
            'short_content',
            'user_id',
            'data_creation',
            'last_modification',
            array(
		    'label'=>'Wpis aktywny',
		    'value'=>(($model->is_active==True)? 'Aktywny' : 'Wyłączony')),
            'tags',
            'nice_link',
            'category_id',
        ],
    ]) ?>

</div>
