<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobHistory */

$this->title = 'Update Job History: ' . $model->employee_id;
$this->params['breadcrumbs'][] = ['label' => 'Job Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->employee_id, 'url' => ['view', 'employee_id' => $model->employee_id, 'start_date' => $model->start_date]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-history-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
