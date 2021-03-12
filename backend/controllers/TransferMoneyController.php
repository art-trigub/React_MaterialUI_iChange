<?php

namespace backend\controllers;

use backend\components\Controller;
use common\models\TransferAgent;
use common\models\TransferPickupBank;
use common\models\TransferType;
use yii\helpers\ArrayHelper;

use common\models\Country;

use yii\helpers\Json;
use yii\helpers\Html;

use Yii;

class TransferMoneyController extends Controller
{
    function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'common\filters\JsonFormatter',
                'only' => ['save']
            ]
        ]);
    }


    /**
     *
     * country_id : {
     *  transfer_type_id: {
     *          agent_id: {
     *              commission: [
     *                  {from: 10, to: 20, value: 1},
     *                  {from: 20, to: 30, value: 2},
     *              ],
     *              maxAmount: null,
     *              pickupBankList: [transfer_pickup_bank_id, ... etc]
     *
     *          }
     *      }
     * }
     *
     * @return string
     */

    public function actionIndex()
    {
        Yii::$app->jsConfig->add([
            'transferMoneyData' => Json::decode(Html::decode(Yii::$app->storage->get('tranferMoneyData', '{}')), false),
            'countryList' => ArrayHelper::toArray(Country::find()->all(), [
                'common\models\Country' => [
                    'country_id',
                    'name'
                ]
            ]),
            'transferTypeList' => ArrayHelper::toArray(TransferType::find()->all(), [
                'common\models\TransferType' => [
                    'transfer_type_id',
                    'label'
                ]
            ]),
            'transferAgentList' => ArrayHelper::toArray(TransferAgent::find()->all(), [
                'common\models\TransferAgent' => [
                    'transfer_agent_id',
                    'label'
                ]
            ]),
            'transferPickupBankList' => ArrayHelper::toArray(TransferPickupBank::find()->all(), [
                'transfer_pickup_bank_id',
                'label'
            ])
        ]);

        return $this->render('index');
    }

    function actionSave()
    {
        $tree = Yii::$app->request->post('tree', '{}');
        Yii::$app->storage->set('tranferMoneyData', $tree);

        return [
            'status' => self::STATUS_OK
        ];
    }

}
