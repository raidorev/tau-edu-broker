<?php

namespace app\models\auth;

use Exception;
use mdm\admin\components\UserStatus;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class RegisterForm extends Model
{
    public string $email = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $patronymic = '';
    public string $password = '';
    public string $retypePassword = '';

    public function attributeLabels(): array
    {
        return [
            'email' => Yii::t('app', 'Адрес электронной почты'),
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'password' => Yii::t('app', 'Пароль'),
            'retypePassword' => Yii::t('app', 'Повторите пароль'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::class,
                'message' => Yii::t('app', 'Введенный email уже занят'),
            ],

            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name', 'patronymic'], 'string', 'max' => 50],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function register(): ?User
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->email = $this->email;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->patronymic = $this->patronymic;
        $user->status = ArrayHelper::getValue(
            Yii::$app->params,
            'user.defaultStatus',
            UserStatus::ACTIVE
        );
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save()) {
            $assignment = new AuthAssignment();
            $assignment->user_id = (string) $user->id;
            $assignment->item_name = 'Маклер';
            $assignment->save();

            Yii::$app->user->login($user);

            return $user;
        }

        return null;
    }
}
