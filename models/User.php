<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string|null $surname
 * @property string $password
 * @property int|null $city_id
 * @property string|null $description
 * @property string $created
 * @property string|null $last_visited
 * @property string $type
 *
 * @property ExecutorCategories[] $executorCategories
 * @property ExecutorPhotos[] $executorPhotos
 * @property Responses[] $responses
 * @property Tasks[] $tasks
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'password', 'type'], 'required'],
            [['city_id'], 'integer'],
            [['description', 'type'], 'string'],
            [['created', 'last_visited'], 'safe'],
            [['email'], 'string', 'max' => 255],
            [['name', 'surname'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'surname' => 'Surname',
            'password' => 'Password',
            'city_id' => 'City ID',
            'description' => 'Description',
            'created' => 'Created',
            'last_visited' => 'Last Visited',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[ExecutorCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorCategories()
    {
        return $this->hasMany(ExecutorCategories::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ExecutorPhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorPhotos()
    {
        return $this->hasMany(ExecutorPhotos::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['user_id' => 'id']);
    }
}
