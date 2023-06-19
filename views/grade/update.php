<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Grade $model */

$this->title = 'Обновить оценку: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Оценки за четверти', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
