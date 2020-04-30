<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JobHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Job History', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'employee_id',
            'start_date',
            'end_date',
            'job_id',
            'department_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
