<?php

namespace app\models\registry;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/** @see EducationalStage */
class EducationalStageQuery extends ActiveQuery
{
    use SerializableQueryTrait;
}
