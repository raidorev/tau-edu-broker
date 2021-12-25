<?php

namespace app\widgets;

use Yii;
use yii\bootstrap4\Dropdown;
use yii\helpers\Url;

class LanguageDropdown extends Dropdown
{
    private static array $languages = [
        'ru' => 'Русский',
        'kk' => 'Қазақ',
        'en' => 'English',
    ];

    public function init()
    {
        parent::init();

        $appLanguage = Yii::$app->language;

        /** @var string[] $languages */
        $languages = Yii::$app->urlManager->languages;
        foreach ($languages as $language) {
            $isWildcard = substr($language, -2) === '-*';
            if (
                $language === $appLanguage ||
                ($isWildcard &&
                    strpos($appLanguage, substr($language, 0, 2)) === 0)
            ) {
                continue; // Исключаем текущий язык
            }

            if ($isWildcard) {
                $language = substr($language, 0, 2);
            }

            $this->items[] = [
                'label' => self::label($language),
                'url' => Url::current(['language' => $language]),
            ];
        }
    }

    public static function label($code)
    {
        return self::$languages[$code] ?? null;
    }
}
