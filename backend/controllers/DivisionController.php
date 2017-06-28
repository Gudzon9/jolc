<?php

namespace backend\controllers;

use Yii;
use common\models\Division;
use common\models\DivisionSearch;
use common\models\Slog;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use common\commands\AddToTimelineCommand;

/**
 * DivisionController implements the CRUD actions for Division model.
 */
class DivisionController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Division models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DivisionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Division model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $slogProvider = new ActiveDataProvider([
            'query' => Slog::find()->where(['tbl_name'=>'division','id_intbl'=>$id]),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        

        return $this->render('view', [
            'model' => $this->findModel($id),
            'slogProvider' => $slogProvider,
        ]);
    }

    /**
     * Creates a new Division model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Division();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Division model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Division model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Division model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Division the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Division::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
