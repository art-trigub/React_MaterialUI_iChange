<?php

namespace frontend\controllers;


use frontend\components\Controller;
use common\models\Page;

class PageController extends Controller
{

	/**
	 * @param $id
	 * @return string|void
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionView($id)
	{
		$model = Page::findOne($id);
		if (!$model) {
			return $this->NotFoundException();
		}

		return $this->render('view', compact('model'));
	}

	public function actionContacts()
	{
		$model = Page::getStaticByName('contacts');

		return $this->render('contacts', compact('model'));
	}
}
