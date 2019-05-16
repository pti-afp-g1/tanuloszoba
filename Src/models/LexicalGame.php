<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%lexical_game}}".
 *
 * @property string $id
 * @property string $resolved
 * @property int $error
 * @property string $afp2_user_id
 *
 * @property User $afp2User
 */
class LexicalGame extends ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%lexical_game}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['error', 'afp2_user_id'], 'integer'],
            [['resolved'], 'string', 'max' => 10],
            [['afp2_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['afp2_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'resolved' => Yii::t('app', 'Idő'),
            'error' => Yii::t('app', 'Hibák'),
            'user' => Yii::t('app', 'Játékos'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'afp2_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return LexicalGameQuery the active query used by this AR class.
     */
    public static function find() {
        return new LexicalGameQuery(get_called_class());
    }

    public function beforeSave($insert) {
        $this->afp2_user_id = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }
}
