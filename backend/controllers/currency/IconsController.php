<?php

namespace backend\controllers\currency;


use backend\components\Controller;
use common\models\CurrencyIcon;
use yii\web\UploadedFile;
use yii\helpers\Json;

use Yii;

class IconsController extends Controller
{
    public $section = 'currency';

    function actionIndex()
    {
        $model = new CurrencyIcon();
        $models = CurrencyIcon::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $files = UploadedFile::getInstances($model, 'imageFiles');

            if( $files ) {
                foreach ($files as $key => $file) {
                    $pi = new CurrencyIcon();
                    if($name = $pi->uploadImage($file))
                    {
                        $pi->image = $name;
                        $pi->save(false);
                    }
                }
            }

            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model,
            'models' => $models
        ]);
    }

    public function actionDeleteIcon($id)
    {
        $success = true;
        $model = CurrencyIcon::findOne($id);
        if($model) {
            $model->delete();
        }

        return Json::encode($success);
    }

    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['icon']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CurrencyIcon::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}