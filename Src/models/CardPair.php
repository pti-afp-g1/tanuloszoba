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
}
