<?php

namespace backend\controllers;

use Yii;
use common\models\TransferCountryAgent;
use common\models\TransferCountryAgentSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;

/**
 * TransferCountryAgentController implements the CRUD actions for TransferCountryAgent model.
 */
class TransferCountryAgentController extends Controller
{

    public $section = '';

    public $topMenuItems = [
        ['label' => 'Actions', 'url' => 'javascript:;', 'icon' => 'flaticon-add', 'items' => [
            ['label' => 'Add new', 'url' => ['/transfer-country-agent/create'], 'icon' => 'flaticon-file']
        ]]
    ];


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
     * Lists all TransferCountryAgent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferCountryAgentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Displays a single TransferCountryAgent model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Creates a new TransferCountryAgent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransferCountryAgent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->transfer_country_agent_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Updates an existing TransferCountryAgent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->request->isAjax) {
                return ;
            } else {
                return $this->redirect(['view', 'id' => $model->transfer_country_agent_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Deletes an existing TransferCountryAgent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransferCountryAgent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransferCountryAgent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransferCountryAgent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
