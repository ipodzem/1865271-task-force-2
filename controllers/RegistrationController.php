<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\City;
use Taskforce\services\Task as TaskService;

class RegistrationController extends Controller
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = new User();
        $cities = City::getList();
        if (Yii::$app->request->getIsPost()) {
            $post = Yii::$app->request->post();
            $user->load($post);

            if (isset($post['User']['responsible']) && $post['User']['responsible'] == 1) {
                $user->type = TaskService::TYPE_EXECUTOR;
            } else {
                $user->type = TaskService::TYPE_CUSTOMER;
            }

            if ($user->validate()) {
                if ($user->save())
                    return $this->redirect(['/']);

            }
        }
        return $this->render('form', ['model' => $user, 'cities' => $cities]);
    }
}
