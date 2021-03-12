<?php

namespace account\controllers;

use account\components\Controller;
use account\models\MoneyTransferModel;
use account\models\TransferMoneyByMobile;
use common\models\Currency;
use common\models\TransferCountryAgent;
use common\models\TransferMoneyCommission;
use common\models\TransferMoneyMatrix;
use common\models\TransferMoneyRequest;
use common\models\TransferPickupBank;
use common\models\TransferType;
use common\models\TransferAgent;
use common\models\Beneficiary;
use common\models\BeneficiaryBank;
use common\models\Country;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\VerbFilter;

use yii\helpers\Html;
use yii\helpers\Json;

use Yii;
use yii\helpers\ArrayHelper;

class MoneyTransfersController extends Controller
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
                    'delete-beneficiary' => ['POST'],
                ],
            ],
            [
                'class' => 'common\filters\JsonFormatter',
                'only' => [
                    'get-transfer-types',
                    'get-transfer-agents',
                    'get-amount-data'
                ]
            ]
        ];
    }

    function actionIndex()
    {
        $model = new TransferMoneyRequest();
        $model->load(Yii::$app->request->queryParams);

        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->user_id = Yii::$app->user->id;
                $model->save(false);

                Yii::$app->session->setFlash('success', 'Request success');
                return [
                    'status' => 'OK'
                ];
            } else {
                $errors = $model->getFirstErrors();
                $error = array_shift($errors);
                return [
                    'status' => 'err',
                    'errors' => $error
                ];
            }
        }

        Yii::$app->jsConfig->add([
            'countryList' => ArrayHelper::index(ArrayHelper::toArray(Country::find()->all(), [
                'common\models\Country' => [
                    'country_id',
                    'currency' => function($model) {
                        return $model->currency ? $model->currency->name : false;
                    },
                    'name'
                ]
            ]), 'country_id'),
            'currencyList' => ArrayHelper::index(ArrayHelper::toArray(Currency::find()->all(), [ //where(['not', ['transfer'  => '']])
                'common\models\Currency' => [
                    'currency_id',
                    'name',
                    'symbol',
                    'crossrate' => function($model) {
                        return (float)($model->transfer?:$model->buy_1_result);
                    },
                ]
            ]), 'name')
//            'transferTypeList' => ArrayHelper::toArray(TransferType::find()->all(), [
//                'common\models\TransferType' => [
//                    'transfer_type_id',
//                    'label',
//                    'commission'
//                ]
//            ]),
//            'transferAgentList' => ArrayHelper::toArray(TransferAgent::find()->all(), [
//                'common\models\TransferAgent' => [
//                    'transfer_agent_id',
//                    'label',
//                    'image' => function($model) {
//                        return $model->image ? $model->imagePath : '';
//                    }
//                ]
//            ]),
//            'transferPickupBankList' => ArrayHelper::toArray(TransferPickupBank::find()->all(), [
//                'transfer_pickup_bank_id',
//                'label'
//            ])
        ]);

        return $this->render('index', [
            'model' => $model
        ]);
    }

    function actionGetTransferTypes($country_id)
    {
        $models = TransferType::find()->alias('t')->innerJoin(['tmm' => TransferMoneyMatrix::tableName()], [
            't.transfer_type_id' => new Expression('tmm.transfer_type_id')
        ])->where(['tmm.country_id' => $country_id])->all();

        return ArrayHelper::index(ArrayHelper::toArray($models, [
            'common\models\TransferType' => [
                'transfer_type_id',
                'name',
                'label'
            ]
        ]), 'transfer_type_id');
    }

    function actionGetTransferAgents($country_id, $transfer_type_id)
    {
        $models = TransferAgent::find()->alias('t')->innerJoin(['tmm' => TransferMoneyMatrix::tableName()], [
            't.transfer_agent_id' => new Expression('tmm.transfer_agent_id')
        ])->where([
            'tmm.country_id' => $country_id,
            'tmm.transfer_type_id' => $transfer_type_id
        ])->all();

        return ArrayHelper::index(ArrayHelper::toArray($models, [
            'common\models\TransferAgent' => [
                'transfer_agent_id',
                'image' => function($model) {
                    return $model->image ? $model->getImagePath() : '';
                },
                'label'
            ]
        ]), 'transfer_agent_id');
    }

    function actionGetAmountData($country_id, $transfer_type_id, $transfer_agent_id)
    {
        $matrix = TransferMoneyMatrix::find()->where([
            'country_id'        => $country_id,
            'transfer_type_id'  => $transfer_type_id,
            'transfer_agent_id' => $transfer_agent_id
        ])->one() ?: new TransferMoneyMatrix();

        $commissions = TransferMoneyCommission::findAll([
            'transfer_money_matrix_id' => $matrix->transfer_money_matrix_id
        ]);

        $countryAgentCourse = TransferCountryAgent::find()->where([
            'country_id' => $country_id,
            'transfer_agent_id' => $transfer_agent_id
        ])->one()?: new TransferCountryAgent;

        $receiveCurrencyNames = [];
        if($matrix->country && $matrix->country->currency) {
            $receiveCurrencyNames[] = $matrix->country->currency->name;
        }
        if($matrix->eur_exists) {
            $receiveCurrencyNames[] = 'EUR';
        }
        if($matrix->usd_exists) {
            $receiveCurrencyNames[] = 'USD';
        }

        return [
            'commissions' => ArrayHelper::toArray($commissions, [
                'common\models\TransferMoneyCommission' => [
                    'dia_from',
                    'dia_to',
                    'value',
                    'type'
                ]
            ]),
            'countryAgentCourse' => ArrayHelper::toArray($countryAgentCourse, [
                'common\models\TransferCountryAgent' => [
                    'LOCAL' => function($model) {
                        return 0;
                    },
                    'EUR' => function($model) {
                        return $model->eur_course?:0;
                    },
                    'USD' => function($model) {
                        return $model->usd_course?:0;
                    }
                ]
            ]),
            'receiveCurrencyNames' => array_unique($receiveCurrencyNames),
            'maxAmount' => ArrayHelper::toArray($matrix, [
                'common\models\TransferMoneyMatrix' => [
                    'LOCAL' => function($model) {
                        return $model->max_local_amount?:0;
                    },
                    'EUR' => function($model) {
                        return $model->max_eur_amount?:0;
                    },
                    'USD' => function($model) {
                        return $model->max_usd_amount?:0;
                    }
                ]
            ])
        ];
    }

//    function actionGetMaxAmount($country_id, $transfer_type_id, $transfer_agent_id)
//    {
//        $matrix = TransferMoneyMatrix::find()->where([
//            'country_id' => $country_id,
//            'transfer_type_id' => $transfer_type_id,
//            'transfer_agent_id' => $transfer_agent_id
//        ])->one() ?: new TransferMoneyMatrix();
//
//        if($matrix) {
//            return ArrayHelper::toArray($matrix, [
//                'common\models\TransferMoneyMatrix' => [
//                    'LOCAL' => function($model) {
//                        return $model->max_local_amount?:0;
//                    },
//                    'EUR' => function($model) {
//                        return $model->max_eur_amount?:0;
//                    },
//                    'USD' => function($model) {
//                        return $model->max_usd_amount?:0;
//                    }
//                ]
//            ]);
//        }
//    }



    function actionCalculate()
    {

    }
//    function actionIndex()
//    {
//        $dataProvider = new ActiveDataProvider([
//            'query' => Beneficiary::find()->where(['user_id' => Yii::$app->user->id]),
//            'pagination' => [
//                'pageSize' => -1
//            ]
//        ]);
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider
//        ]);
//    }
//
//    function actionCreateBeneficiary()
//    {
//        $model = new Beneficiary();
//        $model->bank = new BeneficiaryBank();
//        $model->type = Beneficiary::TYPE_BANK;
//
//        $model->user_id = Yii::$app->user->id;
//        if($model->load(Yii::$app->request->post()) && $model->validate())
//        {
//            if($model->save()) {
//                Yii::$app->session->setFlash('success', Yii::t('app', 'Data saved'));
//            } else {
//                Yii::$app->session->setFlash('error', 'There was an error.');
//            }
//
//            return $this->redirect(['/account/money-transfers']);
//        }
//
//        return $this->render('create-beneficiary', [
//            'model' => $model
//        ]);
//    }
//
//    function actionUpdateBeneficiary($id)
//    {
//        $model = $this->getBeneficiaryModel($id);
//        $model->user_id = Yii::$app->user->id;
//        if($model->load(Yii::$app->request->post()) && $model->validate())
//        {
//            if($model->save()) {
//                Yii::$app->session->setFlash('success', Yii::t('app', 'Data saved'));
//            } else {
//                Yii::$app->session->setFlash('error', 'There was an error.');
//            }
//
//            return $this->redirect(['/account/money-transfers']);
//        }
//
//        return $this->render('update-beneficiary', [
//            'model' => $model
//        ]);
//    }
//
//    function actionDeleteBeneficiary($id)
//    {
//        $this->getBeneficiaryModel($id)->delete();
//
//        return $this->redirect(['/account/money-transfers']);
//    }
//
//    protected function getBeneficiaryModel($id)
//    {
//        $model = Beneficiary::find()->where(['beneficiary_id' => $id])->one();
//        if ($model !== null) {
//            return $model;
//        }
//
//        return $this->NotFoundException();
//    }
}