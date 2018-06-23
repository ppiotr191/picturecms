<?php

namespace app\controllers;

use app\models\RegisterForm;
use app\services\LinkActivate;
use Yii;
use yii\base\Module;
use yii\web\Controller;

class RegisterController extends Controller
{
    public $linkActivator;

    public function __construct(string $id, Module $module,LinkActivate $linkActivator, array $config = [])
    {
        $this->linkActivator = $linkActivator;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('registerFormSubmitted');

            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionActivate(){
        $token = Yii::$app->request->get('token');

        if($user = $this->linkActivator->activateLink($token)){
            Yii::$app->user->login($user,  0);
            $this->redirect('/');
        }

    }

}