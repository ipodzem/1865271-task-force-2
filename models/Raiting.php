<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id
 * @property int $response_id
 * @property int $rating
 * @property string $comment
 * @property string $created
 *
 * @property Responses $response
 */
class Raiting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response_id', 'rating', 'comment'], 'required'],
            [['response_id', 'rating'], 'integer'],
            [['comment'], 'string'],
            [['created'], 'safe'],
            [['response_id'], 'exist', 'skipOnError' => true, 'targetClass' => Responses::className(), 'targetAttribute' => ['response_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'response_id' => 'Response ID',
            'rating' => 'Rating',
            'comment' => 'Comment',
            'created' => 'Created',
        ];
    }

    /**
     * Gets query for [[Response]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponse()
    {
        return $this->hasOne(Responses::className(), ['id' => 'response_id']);
    }
}
