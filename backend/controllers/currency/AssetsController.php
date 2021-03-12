<?php


namespace backend\controllers\currency;

use backend\components\Controller;
use common\models\Currency;
use common\models\CurrencyIcon;
use yii\helpers\ArrayHelper;

use Yii;

class AssetsController extends Controller
{
    public $section = 'currency';

    function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'common\filters\JsonFormatter',
                'only' => ['get-all', 'save']
            ]
        ]);
    }


    function actionIndex()
    {
        return $this->render('index');
    }
    
    function actionGetAll()
    {
        $models = Currency::find()->orderBy('weight ASC')->all();
        $icons = CurrencyIcon::find()->all();
        
        return [
            'items' => ArrayHelper::toArray($models, [
                'common\models\Currency' => [
                    'currency_id',
                    'icon' => function($model) {
                        return [
                            'currency_icon_id' => $model->currency_icon_id,
                            'image' => $model->icon,
                            'imagePath' => $model->icon_path
                        ];
                    },
                    'name',
                    'volume',
                    'middle',
                    'debit',
                    'credit',
                    'buy_1',
                    'sell_1',
                    'buy_2',
                    'sell_2',
                    'transfer'
                ]
            ]),
            'icons' => ArrayHelper::toArray($icons, [
                'common\models\CurrencyIcon' => [
                    'currency_icon_id',
                    'image',
                    'imagePath' => function($model) {
                        if($model->image) {
                            return $model->imagePath;
                        }
                    }
                ]
            ])
        ];
    }

    function actionSave()
    {
        if(Yii::$app->request->isPost) {
            $models = Currency::find()->all();
            $array = ArrayHelper::index($models, 'currency_id');

            $keys = array_keys($array);
            $newKeys = [];

            $errors = [];
            $currencies = Yii::$app->request->post('Currency', []);

            foreach ($currencies as $key => $currency) {
                $currency_id = ArrayHelper::remove($currency, 'currency_id');
                if($currency_id) {
                    $newKeys[] = $currency_id;
                }

                if($currency_id && isset($array[$currency_id])) {
                    $m = $array[$currency_id];
                } else {
                    $m = new Currency;
                }
                $m->attributes = $currency;
                $m->weight = $key;
                try {
                    $m->save(false);
                } catch (\Exception $e) {
                    $errors[] = "Asset[{$m->currency_id}: {$m->name}] not saved: Incorrect decimal value";
                }
            }

            $result = array_diff($keys, $newKeys);
            //for trigger events
            foreach (Currency::find()->where(['in', 'currency_id', $result])->all() as $currency) {
                $currency->delete();
            }

            //Currency::deleteAll(['in', 'currency_id', $result]);
            (new Currency())->trigger(Currency::EVENT_RATES_UPDATED);

            if($errors) {
                return [
                    'status' => self::STATUS_ERR,
                    'errors' => $errors
                ];
            }

            return [
                'status' => self::STATUS_OK
            ];
        }
    }
}