<?php

namespace backend\controllers;

use Yii;
use common\models\Slide;
use common\models\SlideSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;
use yii\web\UploadedFile;
use yii\caching\TagDependency;

/**
 * SliderController implements the CRUD actions for Slide model.
 */
class SliderController extends Controller
{

    public $section = '';

    public $topMenuItems = [
        ['label' => 'Actions', 'url' => 'javascript:;', 'icon' => 'flaticon-add', 'items' => [
            ['label' => 'Add new', 'url' => ['/slider/create'], 'icon' => 'flaticon-file']
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
     * Lists all Slide models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Displays a single Slide model.
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
     * Creates a new Slide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slide();
        $model->template = $this->renderPartial('_template');

        if ($model->load(Yii::$app->request->post())) {
            if($name = $model->uploadImage(UploadedFile::getInstance($model, 'imageFile')))
                $model->image = $name;

            if($model->save()) {
				return $this->redirect(['view', 'id' => $model->slide_id]);
			}
        }

        return $this->render('create', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Updates an existing Slide model.
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
            } elseif($model->deleteImage) {
                $model->deleteImages();
                $model->image = '';
            }

            if($model->save()) {
                TagDependency::invalidate(Yii::$app->cache, ['slider']);
                return $this->redirect(['view', 'id' => $model->slide_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'langList' => Language::getList(),
        ]);
    }

    /**
     * Deletes an existing Slide model.
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
     * Finds the Slide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slide::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
