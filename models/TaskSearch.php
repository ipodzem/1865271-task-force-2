<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;
use Taskforce\services\Task as TaskService;

/**
 * TaskSearch represents the model behind the search form of `app\models\Task`.
 */
class TaskSearch extends Task
{
    public $period;
    public $without_executor;
    public $category_ids = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['period', 'without_executor'], 'integer'],
            ['category_ids', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Task::find()->andWhere(['status' => TaskService::STATUS_NEW]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['IN', 'category_id', $this->category_ids]);
        $query->andFilterWhere(['>=', 'created', date("Y-m-d", strtotime("-" . $this->period . " hours"))]);
        if ($this->without_executor) {
            $query->andWhere(['is', 'executor_id', NULL]);
        }
        return $dataProvider;
    }
}
