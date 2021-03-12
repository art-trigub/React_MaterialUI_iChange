<?php

namespace account\controllers;

use account\components\Controller;

class ContactUsController extends Controller
{
    function actionIndex()
    {
        return $this->render('index');
    }
}