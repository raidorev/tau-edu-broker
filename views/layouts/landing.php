<?php
/**
 * @var string $content
 * @var View   $this
 */

use app\assets\AppAsset;
use app\widgets\LanguageDropdown;
use kartik\icons\Icon;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;

$this->title =
    Yii::t("app", "Маклер") .
    " | " .
    Yii::t("app", "Универсистет Туран-Астана");

AppAsset::register($this);
Icon::map($this);

$navItems = ArrayHelper::getValue(Yii::$app->params, "landing-nav-items", []);

$locales = ["ru" => "Русский", "kk" => "Қазақ", "en" => "English"];

// Убираем текущий язык
$availableLocales = array_filter(
    $locales,
    static function (string $key) {
        return $key !== Yii::$app->language;
    },
    ARRAY_FILTER_USE_KEY
);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags(); ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>
<body class="d-flex flex-column">
<?php $this->beginBody(); ?>

<nav class="navbar navbar-expand-sm navbar-dark sticky-top bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= Url::to(["/"]) ?>">
            <img src="/logo.png" width="50" height="50" alt="<?= Yii::t(
                "app",
                "Логотип"
            ) ?>">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto justify-content-end flex-grow-1">
                <?php foreach ($navItems as $link => $text): ?>
                    <li class="nav-item">
                        <?= Html::a($text, $link, ["class" => ["nav-link"]]) ?>
                    </li>
                <?php endforeach; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <?= $locales[Yii::$app->language] ?>
                    </a>
                    <?= LanguageDropdown::widget([
                        "options" => [
                            "aria" => ["labelledby" => "navbarDropdown"],
                        ],
                    ]) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="flex-grow-1 flex-shrink-0">
    <?= $content ?>
</main>

<footer class="bg-light">
    <div class="text-center py-3">
        © <?= date("Y") ?> Copyright:
        <a href="<?= Url::to(["/"]) ?>">
            <?= Yii::t("app", "Универсистет Туран-Астана") ?>
        </a>
    </div>
</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
