<?php

namespace app\controllers;

use app\models\auth\LoginForm;
use app\models\auth\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'register' => ['post'],
                    'login' => ['get', 'post'],
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function actionIndex(): string
    {
        $this->layout = 'landing';

        return $this->render('index', [
            'register' => new RegisterForm(),
            'login' => new LoginForm(),
        ]);
    }

    public function actionRegister(): Response
    {
        $register = new RegisterForm();
        if (
            $register->load(Yii::$app->request->post()) &&
            ($user = $register->register())
        ) {
            // TODO: Redirect to admin panel
            dd($user);
        }

        return $this->refresh();
    }

    public function actionLogin()
    {
        $login = new LoginForm();
        if ($login->load(Yii::$app->request->post()) && $login->login()) {
            // TODO: Redirect to admin panel
            dd(Yii::$app->user);
            return $this->refresh();
        }

        return $this->render('login', ['login' => $login]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->refresh();
    }
}
