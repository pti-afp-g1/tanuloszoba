<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class CardPair extends ActiveRecord 
{
    public static function tableName()
	{
        return '{{%card_pair}}';
    }
	
    public function rules() 
	{
        return [
            [['card1', 'card2', 'afp2_category_id'], 'required'],
            [['afp2_category_id', 'afp2_user_id'], 'integer'],
            [['card1', 'card2'], 'string', 'max' => 255],
            [['afp2_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['afp2_category_id' => 'id']],
            [['afp2_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['afp2_user_id' => 'id']],
        ];
    }
	
    public function attributeLabels()
	{
        return [
            'id' => Yii::t('app', 'ID'),
            'card1' => Yii::t('app', 'Card1'),
            'card2' => Yii::t('app', 'Card2'),
            'afp2_category_id' => Yii::t('app', 'Afp2 Category ID'),
            'afp2_user_id' => Yii::t('app', 'Afp2 User ID'),
        ];
    }
}
