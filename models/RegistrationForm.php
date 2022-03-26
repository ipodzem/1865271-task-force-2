<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Html;
use Taskforce\services\Task as TaskService;

/**
 * RegistrationForm is the model behind the registration form.
 *
 * @property-read User|null $user
 *
 */
class RegistrationForm extends Model
{
    public $name;
    public $email;
    public $city_id;
    public $password_field;
    public $password_repeat;
    public $responsible;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'password_field', 'password_repeat', 'city_id', 'email'], 'required'],
            ['responsible', 'boolean'],
            [['password_field'], 'string', 'max' => 30, 'min' => 8],
            [
                'password_repeat',
                'compare',
                'compareAttribute' => 'password_field',
                'message' => "Пароли должны совпадать"
            ],

        ];
    }

    /**
     * Create new user
     * @return bool whether the user is saved in successfully
     */
    public function register(): array
    {
        $msg = '';
        $success = false;
        if ($this->validate()) {
            $user = new User;
            $user->type = $this->responsible ? TaskService::TYPE_EXECUTOR : TaskService::TYPE_CUSTOMER;
            $user->load($this->attributes, '');
            if ($user->validate() && $user->save()) {
                $success = true;
            } else {
                $error = $user->getErrorSummary(true);
                if ($error[0]) {
                    $msg = $error[0];
                }
            }
        }
        return ['msg' => $msg, 'success' => $success];
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
            'password_field' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'city_id' => 'Город',
            'description' => 'Описание',
            'created' => 'Created',
            'last_visited' => 'Last Visited',
            'type' => 'Type',
            'responsible' => 'я собираюсь откликаться на заказы'
        ];
    }


}
