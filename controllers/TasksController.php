<?php

namespace app\controllers;

use app\models\Task;
use app\models\Category;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TasksController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $categories = Category::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'categories' => ArrayHelper::map($categories, 'id', 'name'),
            'dataProvider' => $dataProvider,
        ]);
    }

}
