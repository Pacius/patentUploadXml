<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bpp_value".
 *
 * @property int $id
 * @property int $id_plan_params
 * @property int $id_business_plan
 * @property string $value
 *
 * @property BusinessPlanParams $planParams
 * @property BusinessPlan $businessPlan
 */
class BppValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bpp_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_plan_params', 'id_business_plan'], 'required'],
            [['id_plan_params', 'id_business_plan'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['id_plan_params'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessPlanParams::className(), 'targetAttribute' => ['id_plan_params' => 'id']],
            [['id_business_plan'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessPlan::className(), 'targetAttribute' => ['id_business_plan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_plan_params' => 'Id Plan Params',
            'id_business_plan' => 'Id Business Plan',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanParams()
    {
        return $this->hasOne(BusinessPlanParams::className(), ['id' => 'id_plan_params']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessPlan()
    {
        return $this->hasOne(BusinessPlan::className(), ['id' => 'id_business_plan']);
    }
}
