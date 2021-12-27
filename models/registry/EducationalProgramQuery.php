<?php

namespace app\models\registry;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/** @see EducationalProgram */
class EducationalProgramQuery extends ActiveQuery
{
    use SerializableQueryTrait;

    protected function listNameFieldName(): string
    {
        return 'fullname';
    }
}
