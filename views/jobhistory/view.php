<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JobHistory */

$this->title = $model->employee_id;
$this->params['breadcrumbs'][] = ['label' => 'Job Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="job-history-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'employee_id' => $model->employee_id, 'start_date' => $model->start_date], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'employee_id' => $model->employee_id, 'start_date' => $model->start_date], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'employee_id',
            'start_date',
            'end_date',
            'job_id',
            'department_id',
        ],
    ]) ?>

</div>
