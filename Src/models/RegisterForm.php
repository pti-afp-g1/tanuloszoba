<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $email;
		
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            ['username', 'validateUsername'],
            ['email', 'validateEmail'],
            ['email', 'email'],
        ];
    }
	
    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUserByName();

            if ($user) {
                $this->addError($attribute, 'A felhasználónév már létezik.');
            }
        }
    }
}
