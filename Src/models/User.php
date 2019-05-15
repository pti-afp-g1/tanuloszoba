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
}
