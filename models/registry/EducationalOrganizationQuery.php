<?php

namespace app\models\registry;

/**
 * This is the ActiveQuery class for [[EducationalOrganization]].
 *
 * @see EducationalOrganization
 */
class EducationalOrganizationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EducationalOrganization[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EducationalOrganization|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
