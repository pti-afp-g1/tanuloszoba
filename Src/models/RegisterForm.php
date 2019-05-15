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
	
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUserByEmail();

            if ($user) {
                $this->addError($attribute, 'Az e-mail cím már létezik.');
            }
        }
    }	

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password = password_hash($this->password, PASSWORD_BCRYPT);
            $user->email = $this->email;
            return $user->save();
        }
        return false;
    }
}
