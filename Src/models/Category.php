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
}
