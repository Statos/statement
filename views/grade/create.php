<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Grade $model */

$this->title = 'Создать оценку';
$this->params['breadcrumbs'][] = ['label' => 'Оценки за четверти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
