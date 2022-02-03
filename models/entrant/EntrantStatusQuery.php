<?php

namespace app\models\entrant;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/**
 * @see EntrantStatus
 */
class EntrantStatusQuery extends ActiveQuery
{
    use SerializableQueryTrait;
}
