<?php

namespace backend\controllers;

use Yii;
use common\models\TransferAgent;
use common\models\TransferAgentSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;
use yii\web\UploadedFile;

/**
 * TransferAgentController implements the CRUD actions for TransferAgent model.
 */
class TransferAgentController extends Controller
{

    public $section = '';

    public $topMenuItems = [
        ['label' => 'Actions', 'url' => 'javascript:;', 'icon' => 'flaticon-add', 'items' => [
            ['label' => 'Add new', 'url' => ['/transfer-agent/create'], 'icon' => 'flaticon-file']
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
     * Lists all TransferAgent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferAgentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Displays a single TransferAgent model.
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
     * Creates a new TransferAgent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransferAgent();

        if ($model->load(Yii::$app->request->post())) {
            if($name = $model->uploadImage(UploadedFile::getInstance($model, 'imageFile'))) {
                $model->image = $name;
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->transfer_agent_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Updates an existing TransferAgent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($name = $model->uploadImage(UploadedFile::getInstance($model, 'imageFile'))) {
                $model->deleteImages();
                $model->image = $name;
            } else if($model->deleteImage) {
                $model->deleteImages();
                $model->image = '';
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->transfer_agent_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Deletes an existing TransferAgent model.
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
     * Finds the TransferAgent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransferAgent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransferAgent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
