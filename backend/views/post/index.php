<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\Post;
use app\models\User;
use yii\widgets\ActiveForm;
use app\models\UploadForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wpisy';
$this->params['breadcrumbs'][] = $this->title;
$oPost = new Post();
$oUser = new User();
$oUF = new UploadForm();
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Nowy wpis', ['value' => Url::to(['post/create']), 'title' => 'Nowy wpis', 'class' => 'showModalButton btn btn-success']); ?>
    </p>


<?= Html::encode($oPost->id); ?> 

    <?php
    $aPost = $dataProvider->getModels();
    $aUser = $oUser->findIdentity('1');
    foreach ($aPost as $PostKey=>$PostValue)
    {
        $aUser = $oUser->findIdentity($PostValue['user_id']);
    ?>
        <div class="all">
          <div class="row_post less <?php echo ($PostValue['is_active'] ? 'active' : 'unactive') ?>" id="<?=$PostValue['id']?>">
              <div class="row_cont id"><?=$PostValue['id']?></div>
              <div class="row_cont title"><?=$PostValue['title']?></div>
              <div class="row_cont editor">
                  Utworzone przez: <?=$aUser['username']?> dnia <?php echo date('Y-m-d h:m:s', $PostValue['data_creation']);?>
              </div>
          </div>
          <div class="row more more_<?=$PostValue['id']?>">
              <div class="content"><?=$PostValue['content']?></div>
              <div class="pictures">
                    <span class="picTitle">Obrazki do wpisu</span>

                    <?= Html::button('dodaj obrazek', ['value' => Url::to(['UploadForm/add']), 'title' => 'Dodaj obrazek', 'class' => 'showModalButton btn btn-success']); ?>

              
              </div>
          </div>
        </div>

    <?php    
    }
    ?>




</div>