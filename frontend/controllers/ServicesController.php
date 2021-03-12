<?php

namespace frontend\controllers;

use frontend\components\Controller;
use common\models\Service;
use common\models\Page;
use yii\data\ActiveDataProvider;

class ServicesController extends Controller
{
	/**
	 * @return string
	 */
	public function actionIndex()
	{
		$page = Page::getStaticByName('services');
		$dataProvider = new ActiveDataProvider([
			'query' => Service::find()->orderBy('service_id DESC'),
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		return $this->render('index', compact('dataProvider', 'page'));
	}

	/**
	 * @param $id
	 * @return string
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$models = Service::find()->orderBy('service_id DESC')->limit(5)->where(['not in', 'service_id', [$id]])->all();

		return $this->render('view', compact('model', 'models'));
	}

	/**
	 * @param $id
	 * @return Service|void|null
	 * @throws \yii\web\NotFoundHttpException
	 */
	protected function findModel($id)
	{
		if (($model = Service::findOne($id)) !== null) {
			return $model;
		}

		return $this->NotFoundException();
	}
}
