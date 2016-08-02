<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "interview".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property string $planets
 * @property string $astronauts
 * @property integer $planet
 */
class Interview extends \yii\db\ActiveRecord
{

    public $verifyCode; // Добавил элемент "проверочный код"

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interview';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sex', 'planets', 'astronauts', 'planet', 'verifyCode'], 'required'],
            ['name', 'string'],
            ['sex', 'boolean', 'message' => 'Пол выбран не верно.'],
            [
                ['planets', 'planet'],
                'in',
                'range' => range(0, 7),
                'message' => 'Выбран не корректный список планет.',
                'allowArray' => 1
            ],
            [
                'astronauts',
                'in',
                'range' => range(0, 5),
                'message' => 'Выбран не корректный список космонавтов.',
                'allowArray' => 1
            ],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'sex' => 'Пол',
            'planets' => 'Какие планеты обитаемы?',
            'astronauts' => 'Какие космонавты известны?',
            'planet' => 'На какую планету хотели бы полететь?',
            'verifyCode' => 'Проверочный код',
        ];
    }
}
