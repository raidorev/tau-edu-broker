<?php

namespace app\models\auth;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/**
 * @see User
 */
class UserQuery extends ActiveQuery
{
    use SerializableQueryTrait;

    protected function listNameFieldName(): string
    {
        return 'shortNameWithEmail';
    }
}
