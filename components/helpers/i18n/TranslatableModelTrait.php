<?php

namespace app\components\helpers\i18n;

use Exception;
use RuntimeException;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Позволяет использовать магию PHP для получения интернационализированных аттрибутов
 *
 * Рассмотрим на примере:
 *
 * У модели есть аттрибуты `name_ru`, `name_kk` и `name_en`. В зависимости от текущей локали мы
 * хотим получать тот или иной аттрибут. В методе [[localizedAttributesMappers]] прописаны
 * аттрибуты, которые мы хотим получить в той или иной локали в виде:
 * ```
 * ['name' => ['fallback' => 'name_ru', 'ru' => 'name_ru', 'kk' => 'name_kk', 'en' =>
 * 'name_en'], ...]
 * ```
 * При попытке получить свойство [[name]] модели, будет получено значение аттрибута из метода
 * [[localizedAttributesMappers]]
 */
trait TranslatableModelTrait
{
    public function __get($name)
    {
        if (!array_key_exists($name, self::localizedAttributesMappers())) {
            return parent::__get($name);
        }

        return $this->t($name);
    }

    /**
     * Массив соответствий аттрибутов и локализаций в формате
     * ```
     * ['attribute' => ['fallback' => 'attribute_ru', 'ru' => 'attribute_ru', 'kk' =>
     * 'attribute_kk', 'en' => 'english_attribute'], ...]
     * ```
     *
     * @return string[][]
     */
    protected static function localizedAttributesMappers(): array
    {
        return [
            'name' => [
                'fallback' => 'name_ru',
                'ru' => 'name_ru',
                'kk' => 'name_kk',
                'en' => 'name_en',
            ],
        ];
    }

    /**
     * Возвращает значение аттрибута в соответствии с [[localizedAttributesMappers]]
     *
     * @param string $attribute
     *
     * @return string
     * @throws RuntimeException Если аттрибута не существует или он не задан в
     *                          [[localizedAttributesMappers]]
     * @throws Exception Если не удалось получить свойство после всех проверок
     */
    public function t(string $attribute): string
    {
        $locale = explode('-', Yii::$app->language)[0];
        $mappers = self::localizedAttributesMappers();

        if (!array_key_exists($attribute, $mappers)) {
            throw new RuntimeException(
                "Для аттрибута «{$attribute}» не существует переводов"
            );
        }

        $mapper = $mappers[$attribute];
        $actualAttribute = ArrayHelper::getValue($mapper, $locale);

        if ($this->hasAttribute($actualAttribute) && $this->$actualAttribute) {
            return $this->$actualAttribute;
        }
        if ($this->hasAttribute(ArrayHelper::getValue($mapper, 'fallback'))) {
            return $this->{$mapper['fallback']};
        }

        throw new RuntimeException(
            "Не удалось получить интернационализированное значение аттрибута «{$attribute}»"
        );
    }
}
