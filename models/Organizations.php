<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organizations".
 *
 * @property int $id
 * @property string $unn
 * @property string $okno
 * @property string $name
 * @property string $full_name
 * @property string $form_realt
 * @property string $fio_director
 * @property string $phone
 * @property string $email
 * @property string $url
 * @property string $index
 *
 * @property BusinessPlanOrg[] $businessPlanOrgs
 */
class Organizations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unn', 'okno', 'name', 'full_name', 'form_realt', 'fio_director', 'phone', 'email', 'url', 'index'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Уникальный номер',
            'unn' => 'УНП',
            'okno' => 'ОКНО',
            'name' => 'Название',
            'full_name' => 'Полное название',
            'form_realt' => 'Форма собственности',
            'fio_director' => 'ФИО директора',
            'phone' => 'Телефон',
            'email' => 'Email',
            'url' => 'Ссылка на сайт',
            'index' => 'Почтовый индекс',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessPlanOrgs()
    {
        return $this->hasMany(BusinessPlanOrg::className(), ['id_organization' => 'id']);
    }
}
