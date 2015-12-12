<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'title',
            'content:ntext',
            //'short_content',
            'user_id',
             //'data_creation',
            // 'last_modification',
            [        
                'attribute' => 'Aktywny ?',
                'value' => function ($model) {
                    return $model->is_active == TRUE ? 'Aktywny' : 'Niebardzo';
                    },
            ],
            // 'tags','' 
             //'nice_link',
            // 'category_id',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
