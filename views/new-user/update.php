<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NewUser $model */

$this->title = 'Update New User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'New Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="new-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
