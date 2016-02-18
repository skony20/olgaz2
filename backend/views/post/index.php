<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\Post;
use app\models\User;
use yii\widgets\ActiveForm;
use app\models\UploadForm;
use kartik\file\FileInput;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wpisy';
$this->params['breadcrumbs'][] = $this->title;
$oPost = new Post();
$oUser = new User();
$oUploadForm = new UploadForm();
$aPost = $dataProvider->getModels(); 
$aUser = $oUser->findIdentity('1');
$cos = 'NIC';
?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.cookie.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Nowy wpis', ['value' => Url::to(['post/create']), 'title' => 'Nowy wpis', 'class' => 'showModalButton btn btn-success']); ?>
    </p>


    <div class="all">
    <?php

    foreach ($aPost as $PostKey=>$PostValue)
    {
        $aUser = $oUser->findIdentity($PostValue['user_id']);
        $aImages = $oPost->getImages($PostValue['id']); // tutaj będzie tabela z obrazkami
        $sPath = yii\helpers\BaseUrl::home();
    ?>  
       
            <div id="<?=$PostValue['id']?>" class="row_post">
            <div class="less <?php echo ($PostValue['is_active'] ? 'active' : 'unactive') ?>" id="<?=$PostValue['id']?>">
                
                <div class="row_cont id"><?=$PostValue['id']?></div>
                <div class="row_cont title"><?=$PostValue['title']?></div>
                <div class="row_cont editor">
                    <?=$aUser['username']?>: <?php echo date('Y-m-d h:m', $PostValue['data_creation']);?>
                </div>
            </div>
            <?php
            $sButton ="<div class='glyphicon glyphicon-stop status_icon ".($PostValue['is_active'] ? 'activePost' : 'unactivePost')." title='".($PostValue['is_active'] ? 'Wyłącz wpis' : 'Włącz wpis') ."'></div>";
            ?>
<?= Html::a($sButton, ['post/activeunactive', 'id' => $PostValue['id'], 'p_sActive' => ($PostValue['is_active'] ? 'active' : 'unactive')], ['class'=> 'ActiveLink']) ?>
            <div class="row more more_<?=$PostValue['id']?>" id="<?=$PostValue['id']?>">
                <div class="content"><?=$PostValue['content']?></div>
                <div class="pictures">Obrazki do wpisu:<br>
                    <div class="all_images">
                        <?php
                        foreach ($aImages['files'] as $ImagesKey=>$ImagesValue)
                        {
                            echo '<div class="single_image">';
                            echo '<div class="PostImage">';
                            echo  Html::a(HTml::img($sPath.$oUploadForm->sPath.$PostValue['id'].'/'.$oUploadForm->sThumb.'/'.$ImagesValue), $sPath.$oUploadForm->sPath.$PostValue['id'].'/'.$oUploadForm->sBig.'/'.$ImagesValue, ['target' => '_blank']);
                            echo '</div>';
                            echo '<div class=" DeleteImageLink">';
                            echo Html::a('Kasuj', ['deleteimages', 'folder' => $PostValue['id'], 'file' => $ImagesValue], [
                           'class' => 'DeleteImageButton',
                           'data' => [
                               'confirm' => 'Jesteś pewien?',
                               'method' => 'post',
                           ],
                    ]);
                            echo '</div>';
                            echo '</div>';
                            
                        }
                        ?>
                    </div>
                    <div class="add_picture">
                        <?php
                        echo FileInput::widget([
                            'model' => $oUploadForm,
                            'name' => 'attachment_'.$PostValue['id'].'[]',
                            'language' => 'pl',
                            'options' => ['multiple' => true],
                            
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['upload-form/upload?id='.$PostValue['id'].'']),
                                'uploadAsync' => false,
                                'showRemove' => false, 
                                'showPreview' => false,
                                'allowedFileTypes' => array('image'),
                                ]
                        ]);
                            ?>
                    </div>
              
                </div>
                <div class="rightMore">
                    <p>
                    <?= Html::button('Zmień wpis', ['value' => Url::to(['post/update?id='.$PostValue['id']]), 'title' => 'Aktualizuj wpis', 'class' => 'showModalButton btn btn-success']); ?>
                    <?= Html::a('Kasuj wpis', ['delete', 'id' => $PostValue['id']], [
                           'class' => 'btn btn-danger',
                           'data' => [
                               'confirm' => 'Jesteś pewien?',
                               'method' => 'post',
                           ],
                    ]) ?>
                    </p>
              </div>
            </div>
            </div>

    <?php    
    }
  
    ?>
    </div>
    <div class="pagging">
        <?php
        $pages->pageSize = 25;
        echo LinkPager::widget([
                'pagination' => $pages,
                ]);
        ?>
    </div>
    


</div>