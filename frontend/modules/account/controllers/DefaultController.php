<?php

namespace account\controllers;

use account\components\Controller;
use common\models\User;
use account\models\ChangePasswordForm;
use common\models\UserDoc;
use yii\web\UploadedFile;
use Yii;

class DefaultController extends Controller
{
    function actionIndex()
    {
        $model = $this->getUser();

        return $this->render('index', compact('model'));
    }

    function actionEdit()
    {
        $model = $this->getUser();
        $model->scenario = User::SCENARIO_ACCOUNT;

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $imageTypes = [
                User::DOCS_TYPE_PASSPORT,
                User::DOCS_TYPE_WORK
            ];

            foreach ($imageTypes as $type) {
                $files = UploadedFile::getInstances($model, 'imageFiles[' . $type . ']');

                if( $files ) {
                    foreach ($files as $key => $file) {
                        $ud = new UserDoc();
                        if($name = $ud->uploadImage($file))
                        {
                            $ud->image = $name;
                            $ud->user_id = $model->user_id;
                            $ud->doc_type = $type;
                            $ud->save(false);
                        }
                    }
                }
            }

            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Data saved'));
            } else {
                Yii::$app->session->setFlash('error', 'There was an error.');
            }

            return $this->refresh();
        }

        return $this->render('edit', [
            'model' => $model
        ]);
    }

    function actionChangePassword()
    {
        $user = $this->getUser();
        $model = new ChangePasswordForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $user->setPassword($model->newPassword);
            if($user->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Password successfully changed'));
            } else {
                Yii::$app->session->setFlash('error', 'There was an error.');
            }

            return $this->refresh();
        }

        return $this->render('change-password', compact('model'));
    }

    protected function getUser()
    {
        $model = User::find()->with(['passportDocs', 'workDocs'])->where(['user_id' => Yii::$app->user->id])->one();
        if ($model !== null) {
            return $model;
        }

        return $this->NotFoundException();
    }
}
