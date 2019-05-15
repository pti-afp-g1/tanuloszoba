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
	
    public static function find() {
        return new UserQuery(get_called_class());
    }
	
    public static function findIdentity($id) {
        return static::find()->where(['id' => $id])->one();
    }
	
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::find()->where(['id' => 1])->one();
    }
	
    public function getId() {
        return $this->id;
    }
	
    public function getAuthKey() {
        //implementáljuk, ha szükségesséválik
    }
	
    public function validateAuthKey($authKey) {
        //implementáljuk, ha szükségesséválik
    }
	
    public static function findByUsername($username) {
        return static::find()->where(['username' => $username])->one();
    }
	
    public static function findByEmail($email) {
        return static::find()->where(['email' => $email])->one();
    }
	
    public function validatePassword($password) {
        return password_verify($password, $this->password);
    }
	
    public function afterFind() {
        $this->_oldAttributes = $this->attributes;
    }
	
    public function isChanged($attribute) {
        return $this->_oldAttributes[$attribute] !== $this->attributes[$attribute];
    }
	
    public function beforeSave($insert) {
        if (!$insert && $this->isChanged('password')) {
            if (empty($this->password)) {
                $this->password = $this->_oldAttributes['password'];
            } else {
                $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            }
        }
        return parent::beforeSave($insert);
    }

    public function assignNewRole($role)
    {
        $this->revokeAllRole();
        $this->assignRole($role);
    }

    private function assignRole($role) {
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole($role);
        try {
            return $auth->assign($authorRole, $this->id);
        } catch (Exception $e) {
            return false;
        }
    }
}
