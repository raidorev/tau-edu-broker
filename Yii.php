<?php

use yii\BaseYii;

/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends BaseYii
{
    /**
     * @var WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property User $user The user component. This property is read-only. Extended component.
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 *
 * @property null $user The user component. This property is read-only. Extended component.
 */
class ConsoleApplication extends yii\console\Application
{
}

/**
 * @property \app\models\auth\User|null $identity The identity object associated with the currently logged-in user.
 *           null is returned if the user is not logged in (not authenticated).
 */
class User extends \yii\web\User
{
}
