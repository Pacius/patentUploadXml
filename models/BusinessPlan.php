<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business_plan".
 *
 * @property int $id
 * @property string $name
 * @property int $date
 * @property string $description
 * @property string $code
 *
 * @property BppValue[] $bppValues
 * @property BusinessPlanOrg[] $businessPlanOrgs
 */
class BusinessPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'integer'],
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
            'date' => 'Дата создания',
            'description' => 'Описание плана',
            'code' => 'Код',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBppValues()
    {
        return $this->hasMany(BppValue::className(), ['id_business_plan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessPlanOrgs()
    {
        return $this->hasMany(BusinessPlanOrg::className(), ['id_business_plan' => 'id']);
    }
}
