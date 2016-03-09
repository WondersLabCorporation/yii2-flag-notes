<?php

namespace WondersLabCorporation\yii2\flagNotes\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
     * @return array attributelabels
     */
    public function attributeLabels()
    {
        return [
            'flag_type' => Yii::t('flagNotes', 'Flag Type'),
            'flag_description' => Yii::t('flagNotes', 'Flag Description'),
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
