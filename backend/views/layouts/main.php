<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '100 % Handmade by OlgaZ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Wpisy', 'url' => ['/post']],
            ['label' => 'Komentarze', 'url' => ['/comments']],
            ['label' => 'Kategorie', 'url' => ['/category']],
            ['label' => 'Użytkownicy', 'url' => ['/user']],
            ['label' => 'Rodzaje użytkowników', 'url' => ['/roles']],
            Yii::$app->user->isGuest ?
                ['label' => 'Loguj', 'url' => ['/site/login']] :
                [
                    'label' => 'Wyloguj (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>
<?php
yii\bootstrap\Modal::begin([
    'header' => '<span id="modalHeaderTitle"></span>',
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'closeButton' =>['tag'=>'close', 'label'=> 'Zamknij'],
    'clientOptions' => ['backdrop' => 1, 'keyboard' =>True]
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();
?>
<?php
yii\bootstrap\Modal::begin([
    'header' => '<span id="modal2HeaderTitle"></span>',
    'headerOptions' => ['id' => 'moda2lHeader'],
    'id' => 'modal2',
    'size' => 'modal-lg',
    'closeButton' =>['tag'=>'close', 'label'=> 'Zamknij'],
    'clientOptions' => ['backdrop' => 1, 'keyboard' =>True]
]);
echo "<div id='modal2Content'></div>";
yii\bootstrap\Modal::end();
?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
