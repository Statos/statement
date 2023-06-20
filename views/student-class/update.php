<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StudentClass $model */

$this->title = 'Обновление класса: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Классы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="student-class-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
