<?php

use app\models\StudentClass;
use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\StudentClassSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Классы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-class-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать класс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'class' => ActionColumn::class,
                'template' => Helper::filterActionColumn('{view}{update}{delete}'),
            ],
        ],
    ]); ?>


</div>
