<?php

namespace app\models\registry;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/**
 * @see Sex
 */
class SexQuery extends ActiveQuery
{
    use SerializableQueryTrait;
}
