<?php

namespace WondersLabCorporation\yii2\flagNotes\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class FlagNote extends \yii\db\ActiveRecord
{
    const PRIORITY_HIGHEST = 1;
    const PRIORITY_HIGH = 2;
    const PRIORITY_NORMAL = 3;
    const PRIORITY_LOW = 4;
    const PRIORITY_LOWEST = 5;



    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%flag_notes}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['model', 'model_id'], 'required'],
            [['model_id', 'flag_type', 'created_at', 'updated_at'], 'integer'],
            ['flag_description', 'string'],
            [['model'], 'string', 'max' => 255],
            ['flag_type', 'in', 'range' => array_keys(self::getFlagTypeTexts())],
            [['model', 'model_id', 'flag_type', 'flag_description'], 'safe'],
        ];
    }

    /**
     * @return array attributelabels
     */
    public function attributeLabels()
    {
        return [
            'flag_type' => Yii::t('flagNotes', 'Priority'),
            'flag_description' => Yii::t('flagNotes', 'Comments'),
        ];
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }
    
    public static function getFlagTypeTexts()
    {
        return [
            self::PRIORITY_HIGHEST => Yii::t('flagNotes', 'Highest'),
            self::PRIORITY_HIGH => Yii::t('flagNotes', 'High'),
            self::PRIORITY_NORMAL => Yii::t('flagNotes', 'Normal'),
            self::PRIORITY_LOW => Yii::t('flagNotes', 'Low'),
            self::PRIORITY_LOWEST => Yii::t('flagNotes', 'Lowest'),
        ];
    }
}
