<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\RegistrationForm;
use app\models\City;

class RegistrationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays registration form.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new RegistrationForm();
        $cities = City::getList();
        if (Yii::$app->request->getIsPost()) {
            if ($model->load(Yii::$app->request->post())) {
                $res = $model->register();
                if ($res['success'] == true) {
                    return $this->redirect('/');
                } else {
                    \Yii::$app->session->setFlash(
                        'error',
                        $res['msg']
                    );
                }
            }
        }
        return $this->render('form', ['model' => $model, 'cities' => $cities]);
    }
}
