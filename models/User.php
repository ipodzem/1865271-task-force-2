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
 * @property Category[] $Categories
 * @property ExecutorPhoto[] $executorPhotos
 * @property Response[] $responses
 * @property Task[] $tasks
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password_repeat;
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
            [['city_id', 'responsible'], 'integer'],
            [['city_id'], 'exist', 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['description', 'type'], 'string'],
            [['created', 'last_visited'], 'safe'],
            [['score'], 'double'],
            ['email', 'email'],
            ['email', 'unique'],
            [['name', 'surname'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 30, 'min' => 8],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Пароли должны совпадать"],
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
            'name' => 'Ваше имя',
            'surname' => 'Фамилия',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'city_id' => 'Город',
            'description' => 'Описание',
            'created' => 'Created',
            'last_visited' => 'Last Visited',
            'type' => 'Type',
            'responsible' => 'я собираюсь откликаться на заказы'
        ];
    }

    /**
     * Gets query for Profile
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * Gets user rating
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['response_id' => 'id'])->viaTable('responses', ['user_id' => 'id']);
    }

    /**
     * Gets user rating count string
     *
     * @return string
     */
    public function getRatingsCountLabel()
    {
        return Yii::t(
            'app',
            '{delta, plural, 0 {нет отзывов} one{# отзыв} few{# отзыва} many{# отзывов} other{# отзывов}}',
            ['delta' => count($this->ratings)]
        );
    }


    /**
     * Gets score
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScoreCalculation()
    {
        return $this->hasMany(Rating::className(), ['response_id' => 'id'])->viaTable('responses', ['user_id' => 'id'])->average('rating');
    }

    /**
     * Gets place
     *
     * @return integer
     */
    public  function getPlace()
    {
        $users = User::find()->orderBy(['score' => SORT_DESC])->all();
        foreach ($users as $k => $user) {
            if ($this->id == $user->id) {
                return $k;
            }
        }
        return count($users);
    }

    /**
     * Gets count succesfull tasks
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountSuccessfullTasks()
    {
        return $this->hasMany(Rating::className(), ['response_id' => 'id'])->viaTable('responses', ['user_id' => 'id'])->andWhere(['>','rating', '0'])->count();
    }

    /**
     * Gets count fail tasks
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountFailTasks()
    {
        return $this->hasMany(Rating::className(),  ['response_id' => 'id'])->viaTable('responses', ['user_id' => 'id'])->andWhere(['rating' => '0'])->count();
    }

    /**
     * Gets query for [[ExecutorCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('executor_categories', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ExecutorPhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorPhotos()
    {
        return $this->hasMany(ExecutorPhoto::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function beforeSave($insert)
    {
        if (isset($this->password))
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return parent::beforeSave($insert);
    }
}
