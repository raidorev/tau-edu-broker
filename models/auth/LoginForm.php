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
    public string $email = '';
    public string $password = '';
    public bool $rememberMe = true;

    private ?User $_user = null;

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
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute, array $params): void
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
    public function getUser(): ?User
    {
        if (!$this->_user) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
