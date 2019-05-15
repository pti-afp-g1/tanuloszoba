<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use \Exception;

class User extends ActiveRecord implements IdentityInterface {
	
    private $_oldAttributes;
	
    public static function tableName() {
        return 'afp2_user';
    }
	
    public function rules() {
        return [
            [['username', 'email'], 'required'],
            [['username', 'email'], 'unique'],
            ['password', 'required', 'on' => 'insert'],
            [['username'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 99],
            [['password'], 'string', 'max' => 255],
        ];
    }
	
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'authAssignment' => 'Szerepkör',
            'roleName' => 'Szerep'
        ];
    }
}
