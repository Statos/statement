<?php

use app\models\Lesson;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\LessonSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Уроки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'fio_teacher',
            [
                'class' => ActionColumn::class,
                'template' => Helper::filterActionColumn('{view}{update}{delete}'),
            ],
        ],
    ]); ?>


</div>
