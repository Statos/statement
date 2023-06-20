<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StudentClass $model */

$this->title = 'Создание класса';
$this->params['breadcrumbs'][] = ['label' => 'Классы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
