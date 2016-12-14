<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "collateralTypes".
 *
 * @property integer $id
 * @property string $name
 */
class CollateralTypes extends \yii\db\ActiveRecord
{
    public $newName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collateralTypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'newName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return CollateralTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CollateralTypesQuery(get_called_class());
    }
}
