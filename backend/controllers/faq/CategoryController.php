<?php

namespace backend\controllers\faq;

use common\models\Faq;
use Yii;
use common\models\FaqCategory;
use common\models\FaqCategorySearch;
use backend\components\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for FaqCategory model.
 */
class CategoryController extends Controller
{

    public $section = 'faq';

    public $topMenuItems = [
        ['label' => 'Actions', 'url' => 'javascript:;', 'icon' => 'flaticon-add', 'items' => [
            ['label' => 'Add new', 'url' => ['/faq/category/create'], 'icon' => 'flaticon-file']
        ]]
    ];

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'sort' => [
                'class' => 'backend\actions\SortAction',
                'model' => FaqCategory::className()
            ]
        ]);
    }


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
     * Lists all FaqCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new FaqCategory();
        $models = FaqCategory::find()->orderBy('weight DESC')->all();

        return $this->render('index', [
            'models' => $models,
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Displays a single FaqCategory model.
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
     * Creates a new FaqCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FaqCategory();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->faq_category_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }


    /**
     * Updates an existing FaqCategory model.
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
                return $this->redirect(['view', 'id' => $model->faq_category_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Deletes an existing FaqCategory model.
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
     * Finds the FaqCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaqCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaqCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
