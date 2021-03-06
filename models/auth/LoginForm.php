<?php

namespace app\models\auth;

use Yii;
use yii\base\Model;

/**
 * Login form
 *
 * @property-read User|null $user
 */
class LoginForm extends Model
{
    /** @var string */
    public $email = '';
    /** @var string */
    public $password = '';
    /** @var bool */
    public $rememberMe = true;

    /** @var ?User */
    private $_user = null;

    public function attributeLabels(): array
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Пароль'),
            'rememberMe' => Yii::t('app', 'Запомнить меня'),
        ];
    }

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param ?array $params    the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError(
                    $attribute,
                    Yii::t('app', 'Неверное имя пользователя или пароль')
                );
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app
                ->getUser()
                ->login(
                    $this->getUser(),
                    $this->rememberMe ? 3600 * 24 * 30 : 0
                );
        }

        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if (!$this->_user) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
