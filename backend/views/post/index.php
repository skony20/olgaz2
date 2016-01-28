<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\Post;
use app\models\User;
use yii\widgets\ActiveForm;
use app\models\UploadForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wpisy';
$this->params['breadcrumbs'][] = $this->title;
$oPost = new Post();
$oUser = new User();
$oUploadForm = new UploadForm();
$aPost = $dataProvider->getModels(); 
$aUser = $oUser->findIdentity('1');
?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.cookie.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Nowy wpis', ['value' => Url::to(['post/create']), 'title' => 'Nowy wpis', 'class' => 'showModalButton btn btn-success']); ?>
    </p>


<?= Html::encode($oPost->id); ?> 
    <div class="all">
    <?php

    foreach ($aPost as $PostKey=>$PostValue)
    {
        $aUser = $oUser->findIdentity($PostValue['user_id']);
        $aImages = $oPost->getImages($PostValue['id']); // tutaj będzie tabela z obrazkami
    ?>
            <div id="<?=$PostValue['id']?>">
            <div class="row_post less <?php echo ($PostValue['is_active'] ? 'active' : 'unactive') ?>" id="<?=$PostValue['id']?>">
                <div class="row_cont id"><?=$PostValue['id']?></div>
                <div class="row_cont title"><?=$PostValue['title']?></div>
                <div class="row_cont editor">
                    Utworzone przez: <?=$aUser['username']?> dnia <?php echo date('Y-m-d h:m:s', $PostValue['data_creation']);?>
                </div>
            </div>
            <div class="row more more_<?=$PostValue['id']?>" id="<?=$PostValue['id']?>">
                <div class="content"><?=$PostValue['content']?></div>
                <div class="pictures">
                    <div class="picTitle">Obrazki do wpisu:</div>
                    <div class="actual_pictures">
                        <?php $items = [];
                        $sPath = yii\helpers\BaseUrl::home();
                        ?>
                        
                        <?php foreach ($aImages['files'] as $ImagesKey=>$ImagesValue)
                        {
                            $items[]  = array(
                            'url' => $sPath.$oUploadForm->sPath.$PostValue['id'].'/'.$oUploadForm->sBig.'/'.$ImagesValue,
                            'src' => $sPath.$oUploadForm->sPath.$PostValue['id'].'/'.$oUploadForm->sThumb.'/'.$ImagesValue,
                            'rel' => $PostValue['id'],
                            'rel2' => $ImagesValue,
                            );
                        }
                          ?>
                        <?php 
                        echo dosamigos\gallery\Gallery::widget([
                            'items' => $items,
                            'options' => [
                                'id' => 'gallery-widget-' . $PostValue['id'],
                                'thumbnailIndicators'=> false
                            ],
                            'templateOptions' => [
                                'id' => 'blueimp-gallery-' . $PostValue['id']
                            ],
                            'clientOptions' => [
                                'container' => '#blueimp-gallery-' . $PostValue['id']
                            ]

                        ]);

                        ?>
                    </div>
                    <div class="add_picture">
                        <?php
                        echo FileInput::widget([
                            'model' => $oUploadForm,
                            'name' => 'attachment_'.$PostValue['id'].'[]',
                            'options' => ['multiple' => true],
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['upload-form/upload?id='.$PostValue['id'].'']),
                                'uploadAsync' => false,
                                'showPreview' => false,]
                        ]);
                            ?>
                    </div>
              
                </div>
                <div class="right_more">
                    <p>
                    <?= Html::button('Zmień', ['value' => Url::to(['post/update?id='.$PostValue['id']]), 'title' => 'Aktualizuj wpis', 'class' => 'showModalButton btn btn-success']); ?>
                    <?= Html::a('Kasuj', ['delete', 'id' => $PostValue['id']], [
                           'class' => 'btn btn-danger',
                           'data' => [
                               'confirm' => 'Jestes pewien??',
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



</div>