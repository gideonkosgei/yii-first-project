<?php

namespace app\controllers;

use Yii;
use app\models\JobHistory;
use app\models\JobHistorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobHistoryController implements the CRUD actions for JobHistory model.
 */
class JobHistoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all JobHistory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobHistory model.
     * @param integer $employee_id
     * @param string $start_date
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($employee_id, $start_date)
    {
        return $this->render('view', [
            'model' => $this->findModel($employee_id, $start_date),
        ]);
    }

    /**
     * Creates a new JobHistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobHistory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'employee_id' => $model->employee_id, 'start_date' => $model->start_date]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JobHistory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $employee_id
     * @param string $start_date
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($employee_id, $start_date)
    {
        $model = $this->findModel($employee_id, $start_date);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'employee_id' => $model->employee_id, 'start_date' => $model->start_date]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JobHistory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $employee_id
     * @param string $start_date
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($employee_id, $start_date)
    {
        $this->findModel($employee_id, $start_date)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JobHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $employee_id
     * @param string $start_date
     * @return JobHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($employee_id, $start_date)
    {
        if (($model = JobHistory::findOne(['employee_id' => $employee_id, 'start_date' => $start_date])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
