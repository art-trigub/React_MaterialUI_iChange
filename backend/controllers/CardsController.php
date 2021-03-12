<?php

namespace backend\controllers;

use common\models\CardParam;
use Yii;
use common\models\Card;
use common\models\CardSearch;
use backend\components\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;
use yii\web\UploadedFile;

/**
 * CardsController implements the CRUD actions for Card model.
 */
class CardsController extends Controller
{

    public $section = '';

    public $topMenuItems = [
        ['label' => 'Actions', 'url' => 'javascript:;', 'icon' => 'flaticon-add', 'items' => [
            ['label' => 'Add new', 'url' => ['/cards/create'], 'icon' => 'flaticon-file']
        ]]
    ];

    function behaviors()
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
                'only' => ['get-params', 'save-params']
            ]
        ]);
    }


    /**
     * Lists all Card models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Displays a single Card model.
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
     * Creates a new Card model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Card();

        if ($model->load(Yii::$app->request->post())) {
            if($name = $model->uploadImage(UploadedFile::getInstance($model, 'imageFile'))) {
                $model->image = $name;
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->card_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Updates an existing Card model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($name = $model->uploadImage(UploadedFile::getInstance($model, 'imageFile')))
            {
                $model->deleteImages();
                $model->image = $name;
            } else if($model->deleteImage) {
                $model->deleteImages();
                $model->image = '';
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->card_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    public function actionParams($id)
    {
        $model = $this->findModel($id);


        return $this->render('params', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    public function actionGetParams($card_id)
    {
        $model = $this->findModel($card_id);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return ArrayHelper::toArray($model->params, [
            'common\models\CardParam' => [
                'card_param_id',
                'name'
            ]
        ]);
    }

    public function actionSaveParams($card_id)
    {
        $model = $this->findModel($card_id);
        if($model->load(Yii::$app->request->post()))
        {
            $errors = $model->saveCardParams();
            if(!$errors) {
                return [
                    'status' => self::STATUS_OK
                ];
            } else {
                return [
                    'status' => self::STATUS_ERR,
                    'errors' => $errors
                ];
            }
        }

        return [
            'status' => self::STATUS_ERR,
            'errors' => 'Data not loaded'
        ];
    }

    /**
     * Deletes an existing Card model.
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
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
