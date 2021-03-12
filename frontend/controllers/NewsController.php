<?php

namespace frontend\controllers;

use common\models\News;
use common\models\Page;
use frontend\components\Controller;
use yii\data\ActiveDataProvider;


class NewsController extends Controller
{
	public function actionIndex()
	{
		$page = Page::getStaticByName('news');
		$dataProvider = new ActiveDataProvider([
			'query' => News::find()->orderBy('news_id DESC'),
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
		$models = News::find()->orderBy('news_id DESC')->limit(5)->where(['not in', 'news_id', [$id]])->all();

		return $this->render('view', compact('model', 'models'));
	}

	/**
	 * @param $id
	 * @return News|void|null
	 * @throws \yii\web\NotFoundHttpException
	 */
	protected function findModel($id)
	{
		if (($model = News::findOne($id)) !== null) {
			return $model;
		}

		return $this->NotFoundException();
	}
}
