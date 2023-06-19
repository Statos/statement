<?php

use app\models\Grade;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\GradeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Оценки за четверти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить оценку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'student_id',
                'value' => 'student.fio',
                'label' => 'Ученик',
                'filter' => \app\models\Student::getDropDown()
            ],
            [
                'attribute' => 'lesson_id',
                'value' => 'lesson.name',
                'label' => 'Урок',
                'filter' => \app\models\Lesson::getDropDown()
            ],
            'year',
            'quarter',
            'grade',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Grade $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
