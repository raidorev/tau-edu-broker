<?php

namespace app\components\helpers\i18n;

use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{
    public array $supportedLanguages = [];

    public function bootstrap($app): void
    {
        $preferredLanguage = isset($app->request->cookies['language'])
            ? (string) $app->request->cookies['language']
            : null;

        if (empty($preferredLanguage)) {
            $preferredLanguage = $app->request->getPreferredLanguage(
                $this->supportedLanguages
            );
        }

        $app->language = $preferredLanguage;
    }
}
