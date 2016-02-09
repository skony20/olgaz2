<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Roles */

$this->title = 'Nowy typ użytkownika';
$this->params['breadcrumbs'][] = ['label' => 'Typ użytkownika', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
