<?php

namespace app\models\registry;

use app\components\helpers\model\SerializableQueryTrait;
use yii\db\ActiveQuery;

/**
 * @see EducationalOrganization
 */
class EducationalOrganizationQuery extends ActiveQuery
{
    use SerializableQueryTrait;
}
