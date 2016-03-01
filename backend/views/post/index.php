
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Post;
use yii\web\Session;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wpisy';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="messages alert-' . $key . '">' . $message[0] . '</div>';
} ?>
<div class="post-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Nowy wpis', ['value' => Url::to(['post/create']), 'title' => 'Nowy wpis', 'class' => 'showModalButton btn btn-success']); ?>
    </p>

    <?php 
    $dataProvider->pagination->pageSize=15; 
    Yii::setAlias('@images', '/olgaz2/images');
    ?>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'bImages' => 1,    
    'columns' => [

        'id',
        [
            'label' => 'Zdjęcia',
            'format' => 'raw',
            'value' => function ($data) {
            $oImages = new Post();
            $aImagesName = $oImages->getImages($data->id); 
            $sImageName = (isset($aImagesName) ? Yii::getAlias('@images').'/'.$data->id.'/'.$oImages->sThumb.'/'.$aImagesName[2] : Yii::getAlias('@images').$oImages->sPath.'no-image.png');
            return Html::button(Html::img($sImageName, ['class' => 'PostImage']), ['value' => Url::to(['post/insertimages/','id' => $data->id]), 'title' => 'Dodaj obrazki', 'class' => 'addPostImages']);
           
            },
            'contentOptions' => ['class' => 'text-center without-right'],
            'headerOptions' => ['class' => 'without-right']
        ],
        [
            'format' => 'raw',
            'value' =>function($data){
                return Html::tag('div', Html::img(Yii::getAlias('@images').'/cms/more.png', ['class'=> 'next-thumb less', 'rel'=>$data->id]), ['class'=> 'without-left']);},
            'contentOptions' => ['class' => 'text-center without-left'],
            'headerOptions' => ['class' => 'without-left']            
        ],
        'title',
        [
            'label' =>'Data',
            'value' =>'data_creation',
            'format' => 'date',
            'contentOptions' => ['class' => 'editor'],
        ],
        [
            'label' =>'Aktywny',
            'format' => 'raw',
            'value' => function ($data) {
                
                $sActive = Html::tag('div', '', ['class' => 'glyphicon glyphicon-stop status_icon activePost', 'title' => 'Wyłącz wpis', 'rel'=>$data->id, 'rel2' => 'active']);
                $sUnActive = Html::tag('div', '', ['class' => 'glyphicon glyphicon-stop status_icon unactivePost', 'title' => 'Włącz wpis', 'rel'=>$data->id, 'rel2' => 'unactive']);
                $button = ($data->is_active == 1 ? $sActive : $sUnActive);
                return  $button;
            },
            'contentOptions' => ['class' => 'text-center']
        ],
        [
        'class' => 'yii\grid\ActionColumn',
        'template'    => '{update}{view}{delete}'
]
    ],

]);?>

<?php
$dataProvider = new ActiveDataProvider([
    'pagination' => [
	    'pagesize' => 10,
    ],
]);
?>
</div>