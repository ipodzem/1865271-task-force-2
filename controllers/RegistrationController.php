<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\RegistrationForm;
use app\models\City;


class RegistrationController extends Controller
{

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
                if ($this->request->isAjax) {
                    $this->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
                if ($model->register()) {
                    return $this->redirect('/');
                }
            }
        }
        return $this->render('form', ['model' => $model, 'cities' => $cities]);
    }
}
