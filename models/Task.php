<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $executor_id
 * @property string $name
 * @property string $description
 * @property int $budget
 * @property string $term
 * @property int|null $city_id
 * @property string $address
 * @property string|null $address_comment
 * @property float $lat
 * @property float $long
 * @property int $category_id
 * @property string $created
 * @property string $status
 *
 * @property Category $category
 * @property City $city
 * @property Response[] $responses
 * @property TaskAttachment[] $taskAttachments
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'description', 'budget', 'term', 'address', 'lat', 'long', 'category_id', 'created', 'status'], 'required'],
            [['user_id', 'executor_id', 'budget', 'city_id', 'category_id'], 'integer'],
            [['description'], 'string'],
            [['term', 'created'], 'safe'],
            [['lat', 'long'], 'number'],
            [['name', 'address', 'address_comment'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 55],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'executor_id' => 'Executor ID',
            'name' => 'Name',
            'description' => 'Description',
            'budget' => 'Budget',
            'term' => 'Term',
            'city_id' => 'City ID',
            'address' => 'Address',
            'address_comment' => 'Address Comment',
            'lat' => 'Lat',
            'long' => 'Long',
            'category_id' => 'Category ID',
            'created' => 'Created',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachment::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
