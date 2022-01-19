<?php

namespace app\models\registry;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/**
 * @see EducationLevel
 */
class EducationLevelQuery extends ActiveQuery
{
    use SerializableQueryTrait;
}
