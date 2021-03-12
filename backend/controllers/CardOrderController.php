<?php

namespace backend\controllers;

use common\models\Card;
use common\models\Country;
use Yii;
use common\models\CardOrder;
use common\models\CardOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CardOrderController implements the CRUD actions for CardOrder model.
 */
class CardOrderController extends Controller
{

	public $section = '';

	public $topMenuItems = [
		['label' => 'Actions', 'url' => 'javascript:;', 'icon' => 'flaticon-add', 'items' => [
			['label' => 'Add new', 'url' => ['/card-order/create'], 'icon' => 'flaticon-file']
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
     * Lists all CardOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CardOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CardOrder model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CardOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CardOrder();
        $countries = Country::find()->orderByName()->all();
        $cards = Card::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->card_order_id]);
        }

        return $this->render('create', [
            'model' => $model,
			'countries' => $countries,
			'cards' => $cards
        ]);
    }

    /**
     * Updates an existing CardOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$countries = Country::find()->orderByName()->all();
		$cards = Card::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->card_order_id]);
        }

        return $this->render('update', [
            'model' => $model,
			'countries' => $countries,
			'cards' => $cards
        ]);
    }

    /**
     * Deletes an existing CardOrder model.
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
     * Finds the CardOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CardOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CardOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
