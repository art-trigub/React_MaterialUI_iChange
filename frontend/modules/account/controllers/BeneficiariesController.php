<?php

namespace account\controllers;

use common\models\Beneficiary;
use common\models\BeneficiaryBank;
use common\models\BeneficiaryPickup;
use yii\filters\VerbFilter;
use account\components\Controller;
use yii\data\ActiveDataProvider;

use Yii;

class BeneficiariesController extends Controller
{
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

    function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Beneficiary::find()->where(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => -1
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    function actionCreate()
    {
        $model = new Beneficiary();
//        $model->bank = new BeneficiaryBank();
//        $model->pickup = new BeneficiaryPickup();
//        $model->type = Beneficiary::TYPE_BANK;

        $model->user_id = Yii::$app->user->id;
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Data saved'));
            } else {
                Yii::$app->session->setFlash('error', 'There was an error.');
            }

            return $this->redirect(['/account/beneficiaries']);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    function actionUpdate($id)
    {
        $model = $this->getModel($id);
        $model->user_id = Yii::$app->user->id;
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Data saved'));
            } else {
                Yii::$app->session->setFlash('error', 'There was an error.');
            }

            return $this->redirect(['/account/beneficiaries']);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    function actionDelete($id)
    {
        $this->getModel($id)->delete();

        return $this->redirect(['/account/beneficiaries']);
    }

    protected function getModel($id)
    {
        $model = Beneficiary::find()->where(['beneficiary_id' => $id])->one();
        if ($model !== null) {
            return $model;
        }

        return $this->NotFoundException();
    }
}