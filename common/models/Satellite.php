<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "satellite".
 *
 * @property integer $id
 * @property string $name
 * @property integer $planet_id
 *
 * @property Planet $planet
 */
class Satellite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'satellite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'planet_id'], 'required'],
            [['planet_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['planet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planet::className(), 'targetAttribute' => ['planet_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'planet_id' => 'Planet ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanet()
    {
        return $this->hasOne(Planet::className(), ['id' => 'planet_id']); //hasOne - отношение один к одному(звезда имеет много планет)
    }
}
