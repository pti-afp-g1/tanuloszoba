<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\db\Expression;

class UserSearch extends User {
	
    public $roleName;
	
    public function rules() {
        return [
            [['id'], 'integer'],
            [['username', 'email', 'password', 'roleName'], 'safe'],
        ];
    }
}
