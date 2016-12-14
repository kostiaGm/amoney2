<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CollateralTypes]].
 *
 * @see CollateralTypes
 */
class CollateralTypesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CollateralTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CollateralTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
