<?php

namespace app\models\conflict;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/**
 * @see ConflictStatus
 */
class ConflictStatusQuery extends ActiveQuery
{
    use SerializableQueryTrait;
}
