<?php

use app\models\Student;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\StudentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ученики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'last_name',
            'first_name',
            'patronymic',
            [
                'attribute' => 'class_id',
                'value' => 'studentClass.name',
                'filter' => \app\models\StudentClass::getDropDown(),
            ],
            [
                'class' => ActionColumn::class,
                'template' => Helper::filterActionColumn('{view}{update}{delete}'),
            ],
        ],
    ]); ?>


</div>
