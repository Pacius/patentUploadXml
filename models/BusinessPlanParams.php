<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business_plan_params".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $code
 *
 * @property BppValue[] $bppValues
 */
class BusinessPlanParams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_plan_params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Уникальный номер',
            'name' => 'Название',
            'description' => 'Описание',
            'code' => 'Код',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBppValues()
    {
        return $this->hasMany(BppValue::className(), ['id_plan_params' => 'id']);
    }
}
