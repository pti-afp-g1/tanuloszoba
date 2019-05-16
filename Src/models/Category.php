<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%category}}';
    }
	
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['afp2_user_id'], 'integer'],
            [['title'], 'string', 'max' => 99],
            [['afp2_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['afp2_user_id' => 'id']],
        ];
    }	
	
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'afp2_user_id' => Yii::t('app', 'Afp2 User ID'),
        ];
    }
	
    public function getCardPairs()
    {
        return $this->hasMany(CardPair::class, ['afp2_category_id' => 'id']);
    }
	
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'afp2_user_id']);
    }
}
