<?php

namespace app\models;

use Yii;

class AuthAssignment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }
	
}
