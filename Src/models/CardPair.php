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
}
