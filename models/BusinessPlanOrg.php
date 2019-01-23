<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business_plan_org".
 *
 * @property int $id
 * @property int $id_business_plan
 * @property int $id_organization
 * @property int $value
 *
 * @property BusinessPlan $businessPlan
 * @property Organizations $organization
 */
class BusinessPlanOrg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_plan_org';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_business_plan', 'id_organization'], 'required'],
            [['id_business_plan', 'id_organization', 'value'], 'integer'],
            [['id_business_plan'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessPlan::className(), 'targetAttribute' => ['id_business_plan' => 'id']],
            [['id_organization'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['id_organization' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Уникальный номер',
            'id_business_plan' => 'Бизнес план',
            'id_organization' => 'Организация',
            'value' => 'Используется',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessPlan()
    {
        return $this->hasOne(BusinessPlan::className(), ['id' => 'id_business_plan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'id_organization']);
    }
}
