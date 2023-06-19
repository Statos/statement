<?php

/** @var yii\web\View $this */

$this->title = 'Ведомость';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Ведомость</h1>

        <h3>
            <?= !Yii::$app->user->isGuest ? 'Вы авторизованы' : '' ?>
        </h3>

        <p class="lead">Yii-powered application.</p>
    </div>

</div>
