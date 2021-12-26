<?php

use app\assets\AppAsset;
use app\assets\MetisMenuAsset;
use app\components\helpers\ViewHelper;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/**
 * @var View $this
 * @var string $content
 */

AppAsset::register($this);
MetisMenuAsset::register($this);

$this->registerCssFile('/dist/css/views/layouts/main.css');
$this->registerJs("$('#aside-menu').metisMenu().show()",View::POS_READY);

if (!$this->title) {
    Yii::info('Страница не имеет заголовка');
}
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php if ($this->title): ?>
        <title><?= Html::encode($this->title) ?>
            – <?= Html::encode(Yii::t('app', Yii::$app->name)) ?></title>
    <?php else: ?>
        <title><?= Html::encode(Yii::t('app', Yii::$app->name)) ?></title>
    <?php endif; ?>
    <?php $this->head(); ?>
</head>

<body>
<?php $this->beginBody(); ?>

<div class="h-100 d-flex flex-column">
    <nav>
        <?php NavBar::begin([
            'renderInnerContainer' => false,
            'brandLabel' => Yii::t('app', Yii::$app->name),
        ]); ?>
        <?= Nav::widget([
            'options' => ['class' => ['nav', 'justify-content-end', 'w-100']],
            'items' => [
                [
                    'label' =>
                        Icon::show('sign-in-alt') . Yii::t('app', 'Войти'),
                    'url' => ['/site/login'],
                    'linkOptions' => [
                        'class' => ['nav-link', 'text-secondary'],
                    ],
                    'encode' => false,
                    'visible' => Yii::$app->user->isGuest,
                ],
                [
                    'label' =>
                        Icon::show('sign-out-alt') . Yii::t('app', 'Выйти'),
                    'url' => ['/site/logout'],
                    'linkOptions' => [
                        'class' => ['nav-link', 'text-secondary'],
                        'data' => [
                            'method' => 'post',
                        ],
                    ],
                    'encode' => false,
                    'visible' => !Yii::$app->user->isGuest,
                ],
            ],
        ]) ?>
        <?php NavBar::end(); ?>
    </nav>

    <div class="d-flex flex-auto">
        <aside class="bg-light">
            <?= ViewHelper::generateAsideNav() ?>
        </aside>

        <main class='my-3 container-fluid'>
            <?= Breadcrumbs::widget([
                'options' => ['class' => ['breadcrumb', 'bg-light']],
                'itemTemplate' => Html::tag('li', '<i>{link}</i>', [
                    'class' => ['breadcrumb-item'],
                ]),
                'activeItemTemplate' => Html::tag('li', '{link}', [
                    'class' => ['breadcrumb-item', 'active'],
                ]),
                'links' => $this->params['breadcrumbs'] ?? [],
            ]) ?>

            <?= ViewHelper::generateAlerts() ?>

            <?= $content ?>
        </main>
    </div>
</div>

<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
