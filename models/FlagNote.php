<?php

namespace WondersLabCorporation\yii2\flagNotes\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use WondersLabCorporation\yii2\flagNotes\FlagNotes;

class FlagNote extends \yii\db\ActiveRecord
{
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
            [['model', 'model_id', 'flag_type', 'flag_description'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'flag_type' => FlagNotes::t('messages', 'model_flag_type'),
            'flag_description' => FlagNotes::t('messages', 'model_flag_description'),
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
}
