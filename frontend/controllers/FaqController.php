<?php

namespace frontend\controllers;

use common\models\Faq;
use common\models\FaqCategory;
use frontend\components\Controller;

class FaqController extends Controller
{
	/**
	 * @param  null  $category_id
	 * @return string|void
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionIndex($category_id = null)
	{
		if ($category_id) {
			$categoryModel = FaqCategory::findOne($category_id);
			if (!$categoryModel) {
				return $this->NotFoundException();
			}
			$questions = $categoryModel->getQuestions()->orderBy('weight DESC')->all();
		} else {
			$categoryModel = new FaqCategory();
			$questions = Faq::find()->orderBy('weight DESC')->all();
		}

		$categories = FaqCategory::find()->orderBy('weight DESC')->all();

		return $this->render('index', [
			'questions' => $questions,
			'categoryModel' => $categoryModel,
			'categories' => $categories
		]);
	}

//    public function actionCategory($id)
//    {
//        $category = FaqCategory::findOne($id);
//        if(!$category) {
//            return $this->NotFoundException();
//        }
//        $questions = $category->getQuestions()->orderBy('weight DESC');
//        $categories = FaqCategory::find()->orderBy('weight DESC')->all();
//
//        return $this->render('category', [
//            'category' => $category
//        ]);
//    }
}
