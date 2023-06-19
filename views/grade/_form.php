<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Grade $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->dropDownList(\app\models\Student::getDropDown()) ?>

    <?= $form->field($model, 'lesson_id')->dropDownList(\app\models\Lesson::getDropDown()) ?>

    <?= $form->field($model, 'year')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'quarter')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'grade')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
