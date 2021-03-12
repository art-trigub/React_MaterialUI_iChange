<?php

namespace backend\controllers;

use common\models\TransferMoneyCommission;
use Yii;
use common\models\TransferMoneyMatrix;
use common\models\TransferMoneyMatrixSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * TransferMoneyMatrixController implements the CRUD actions for TransferMoneyMatrix model.
 */
class TransferMoneyMatrixController extends Controller
{

    public $section = '';

    public $topMenuItems = [
        ['label' => 'Actions', 'url' => 'javascript:;', 'icon' => 'flaticon-add', 'items' => [
            ['label' => 'Add new', 'url' => ['/transfer-money-matrix/create'], 'icon' => 'flaticon-file']
        ]]
    ];


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => 'common\filters\JsonFormatter',
                'only' => ['save-commission']
            ]
        ]);
    }

    /**
     * Lists all TransferMoneyMatrix models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferMoneyMatrixSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Displays a single TransferMoneyMatrix model.
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
     * Creates a new TransferMoneyMatrix model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransferMoneyMatrix();

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->transfer_money_matrix_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    public function actionCommission($id)
    {
        $model = $this->findModel($id);
        $models = TransferMoneyCommission::findAll(['transfer_money_matrix_id' => $id]);
//        if(!$model) {
//            $model = new TransferMoneyCommission();
//            $model->transfer_money_matrix_id = $id;
//            $model->save(false);
//        }

        Yii::$app->jsConfig->add([
            'transferMoneyCommissionList' => ArrayHelper::toArray($models, [
                'common\models\TransferMoneyCommission' => [
                    'transfer_money_commission_id',
                    'dia_from',
                    'dia_to',
                    'value',
                    'type'
                ]
            ]),
            'valueTypes' => [
                [
                    'text'  => '%',
                    'value' => '%'
                ],
                [
                    'text'  => 'n',
                    'value' => 'n'
                ]
            ]
//            'valueTypes' => [
//                '%' => '%',
//                'n' => 'n'
//            ]
        ]);

        return $this->render('commission', [
            'models' => $models,
            'model' => $model
        ]);
    }

    public function actionSaveCommission($id)
    {
        if(Yii::$app->request->isPost) {
            $models = TransferMoneyCommission::findAll(['transfer_money_matrix_id' => $id]);
            $array = ArrayHelper::index($models, 'transfer_money_commission_id');

            $keys = array_keys($array);
            $newKeys = [];

            $errors = [];
            foreach (Yii::$app->request->post('commission', []) as $key => $data) {
                $commission_id = ArrayHelper::remove($data, 'transfer_money_commission_id');
                if($commission_id) {
                    $newKeys[] = $commission_id;
                }

                if($commission_id && isset($array[$commission_id])) {
                    $m = $array[$commission_id];
                } else {
                    $m = new TransferMoneyCommission;
                }
                $m->attributes = $data;
                $m->transfer_money_matrix_id = $id;
                try {
                    $m->save(false);
                } catch (\Exception $e) {
                    $errors[] = "Commission[{$m->transfer_money_commission_id} {$e->getMessage()} not saved";
                }
            }

            $result = array_diff($keys, $newKeys);
            TransferMoneyCommission::deleteAll(['in', 'transfer_money_commission_id', $result]);

            if($errors) {
                return [
                    'status' => self::STATUS_ERR,
                    'errors' => $errors
                ];
            }

            return [
                'status' => self::STATUS_OK
            ];
        }
    }

    /**
     * Updates an existing TransferMoneyMatrix model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->transfer_money_matrix_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Deletes an existing TransferMoneyMatrix model.
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
     * Finds the TransferMoneyMatrix model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransferMoneyMatrix the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransferMoneyMatrix::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
