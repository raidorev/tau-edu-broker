<?php

namespace app\components\helpers;

use Exception;
use kartik\alert\Alert;
use mdm\admin\components\MenuHelper;
use mdm\admin\models\Menu;
use Yii;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

/**
 * Класс для вспомогательных функций, используемых для представлений
 */
final class ViewHelper
{
    /**
     * Генерирует хлебные крошки для текущего представления
     *
     * Хлебные крошки генерируются из таблицы `menu`. Метод предоставляет два варианта генерации:
     * - для страницы из меню;
     * - для зависимой страницы.
     *
     * Для генерации хлебных крошек для первого варианта нужно не передавать никаких аргументов и
     * страница сгенерируется исходя из цепочки меню.
     *
     * Для генерации второго варианта необходимо передать название текущей страницы и при
     * необходимости указать, что эта страница находится на том же маршруте, что и
     * страница-родитель
     *
     * Предположим, у нас есть страница "Журналы", которая находится в пункте меню "Успеваемость".
     * Открыв её в первый раз, на ней будет форма для выбора группы, после выбора группы на
     * странице появится список дисциплин, при переходе на оценки какой-либо дисциплины откроется
     * другая страница по другому маршруту, которого нет в меню. В первых двух случаях маршрут
     * будет `/grades/journal`, во втором - `/grades/journal/discipline`. В первом случае URL будет
     * выглядеть следующим образом - `/grades/journal`, во втором - `/grades/journal?group=1234`, в
     * третьем - `/grades/journal/discipline?id=4321&group=1234`.
     *
     *  ```php
     * <?php
     * // Первый и второй случай
     * ViewHelper::addBreadcrumbs(); // Главная > Успеваемость > Журналы
     *
     * // Третий случай
     * ViewHelper::addBreadcrumbs('СМС-110'); // Главная > Успеваемость > Журналы > СМС-110
     * ```
     *
     * Если отображение зависимой страницы находится на том же маршруте, что и основная страница,
     * следует передать аргумент `$samePage` равный `true`. Например, есть страница "Аттестация" в
     * пункте "Успеваемость". На ней форма выбора группы (1 случай), после выбора на этой же
     * странице отображается ведомость на эту группу (2 случай). В обоих случаях маршрут равен
     * `/grades/attendance`.
     *
     * ```php
     * <?php
     * // Первый случай
     * ViewHelper::addBreadcrumbs(); // Главная > Успеваемость > Аттестация
     *
     * // Второй случай
     * ViewHelper::addBreadcrumbs('СМС-110', true); // Главная > Успеваемость > Аттестация > СМС-110
     * ```
     *
     * Прим.: не следует путать понятия *маршрут* и *путь*, *ссылка*, *URL*. Маршрут это то, что
     * прописано в таблице `menu`, он не может иметь параметры или якоря.
     *
     * @param string|null $currentPage Название текущей зависимой страницы
     * @param bool $samePage Находится ли зависимая страница на том же маршруте, что и
     *                                 основная
     */
    public static function addBreadcrumbs(
        ?string $currentPage = null,
        bool $samePage = false
    ): void {
        $route = '/' . Yii::$app->requestedRoute;

        if ($currentPage) {
            $breadcrumbs = self::generateBreadcrumbsForDependentPage(
                $route,
                $currentPage,
                $samePage
            );
        } else {
            $breadcrumbs = self::generateBreadcrumbsForMenuPage($route);
        }

        Yii::$app->view->params['breadcrumbs'] = $breadcrumbs;
    }

    /**
     * @param string $route Текущий маршрут
     * @param string $currentPage Смотри {@see ViewHelper::addBreadcrumbs()}
     * @param bool $samePage Смотри {@see ViewHelper::addBreadcrumbs()}
     *
     * @return array Хлебные крошки в формате
     *               `[['url' => '...', 'label' => '...'], ..., $currentPage]`
     */
    private static function generateBreadcrumbsForDependentPage(
        string $route,
        string $currentPage,
        bool $samePage
    ): array {
        $parts = explode('/', $route);
        if (!$samePage) {
            array_pop($parts);
            $parts[] = 'index';
        }
        array_shift($parts);

        $currentRoute = '/' . implode('/', $parts);
        $breadcrumbs = self::generateBreadcrumbsForMenuPage($currentRoute);
        $breadcrumbs[] = $currentPage;

        return $breadcrumbs;
    }

    /**
     * @param string $route
     *
     * @return array Хлебные крошки в формате
     *               `[['url' => '...', 'label' => '...'], ..., 'Current page']`
     */
    private static function generateBreadcrumbsForMenuPage(string $route): array
    {
        $menuItem = Menu::findOne(['route' => $route]);

        $breadcrumbs = [];
        while ($menuItem) {
            if ($menuItem->route) {
                $breadcrumbs[] = [
                    'url' => $menuItem->route,
                    'label' => $menuItem->name,
                ];
            } else {
                $breadcrumbs[] = $menuItem->name;
            }

            /** @var Menu|null $menuItem */
            $menuItem = $menuItem->menuParent;
        }

        return array_reverse($breadcrumbs);
    }

    /**
     * Генерирует HTML с сообщениями из `Yii::$app->session->allFlashes`
     *
     * @throws Exception
     */
    public static function generateAlerts(): string
    {
        if (count(Yii::$app->session->allFlashes) === 0) {
            return '';
        }

        static $icons = [
            'success' => 'check-circle',
            'info' => 'info',
            'waring' => 'exclamation-triangle',
            'danger' => 'exclamation-circle',
        ];

        ob_start();

        foreach (Yii::$app->session->allFlashes as $type => $flashes) {
            if (!is_array($flashes)) {
                $flashes = [$flashes];
            }

            foreach ($flashes as $flash) {
                $icon = ArrayHelper::getValue(
                    $flash,
                    'icon',
                    ArrayHelper::getValue($icons, $type)
                );
                if ($icon) {
                    $icon = "fas fa-$icon";
                }

                if (is_string($flash)) {
                    echo Alert::widget([
                        'type' => "alert-$type",
                        'icon' => $icon,
                        'iconOptions' => [
                            'class' => 'mr-1',
                        ],
                        'body' => $flash,
                    ]);
                } else {
                    $showSeparator = array_key_exists('title', $flash);

                    echo Alert::widget([
                        'type' => "alert-$type",
                        'closeButton' => ArrayHelper::getValue(
                            $flash,
                            'permanent',
                            false
                        )
                            ? false
                            : [],
                        'showSeparator' => $showSeparator,
                        'icon' => $icon,
                        'title' => ArrayHelper::getValue($flash, 'title'),
                        'body' => ArrayHelper::getValue($flash, 'body'),
                        'delay' => ArrayHelper::getValue($flash, 'delay'),
                    ]);
                }
            }
        }

        return ob_get_clean();
    }

    /**
     * Генерирует HTML с боковым меню сайта. Элементы меню берутся из назначений пользователя.
     *
     * @return false|string
     */
    public static function generateAsideNav()
    {
        $menuItems = MenuHelper::getAssignedMenu(Yii::$app->user->id);

        ob_start();

        echo Html::beginTag('nav', ['class' => ['sidebar-nav']]);
        echo Html::beginTag('ul', [
            'id' => 'aside-menu',
            'class' => ['metismenu'],
        ]);
        foreach ($menuItems as $key => $item) {
            echo self::printAsideMenuItem((string) $key, $item);
        }
        echo Html::endTag('ul');
        echo Html::endTag('nav');

        return ob_get_clean() ?: '';
    }

    private static function printAsideMenuItem(string $key, array $item): string
    {
        $isLeaf = !array_key_exists('items', $item);

        ob_start();

        if (!$isLeaf) {
            echo Html::beginTag('li', ['data' => ['key' => $key]]);
            echo Html::a($item['label'], '#', [
                'class' => ['has-arrow'],
                'aria' => ['expended' => false],
            ]);
            echo Html::beginTag('ul', ['class' => 'mm-collapse']);
            foreach ($item['items'] as $subKey => $subItem) {
                echo self::printAsideMenuItem("$key-$subKey", $subItem);
            }
            echo Html::endTag('ul');
            echo Html::endTag('li');

            return ob_get_clean();
        }

        $href = is_array($item['url']) ? $item['url'][0] : $item['url'];
        $active = $href === '/' . Yii::$app->requestedRoute;

        echo Html::beginTag('li', [
            'class' => [!$active ?: 'mm-active'],
        ]);
        echo Html::a($item['label'], $href);
        echo Html::endTag('li');

        return ob_get_clean();
    }
}
