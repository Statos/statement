<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\GradeSearch $searchModel */
/** @var yii\data\ArrayDataProvider $dataProvider */

$this->title = 'Оценки за год';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-total">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'student_id',
                'value' => 'student',
                'label' => 'Ученик',
                'filter' => \app\models\Student::getDropDown()
            ],
            [
                'attribute' => 'lesson_id',
                'value' => 'lesson',
                'label' => 'Урок',
                'filter' => \app\models\Lesson::getDropDown()
            ],
            'year',
            'quarter1:text:1-ая четверть',
            'quarter2:text:2-ая четверть',
            'quarter3:text:3-яя четверть',
            'quarter4:text:4-ая четверть',
            'grade:text:Среднее',
        ],
    ]); ?>


</div>
