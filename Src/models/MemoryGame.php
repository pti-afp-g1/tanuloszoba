<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%memory_game}}".
 *
 * @property string $id
 * @property string $resolved
 * @property string $afp2_user_id
 *
 * @property User $afp2User
 */
class MemoryGame extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%memory_game}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['afp2_user_id'], 'integer'],
            [['resolved'], 'string', 'max' => 10],
            [['afp2_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['afp2_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'resolved' => Yii::t('app', 'Idő'),
            'user' => Yii::t('app', 'Játékos'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'afp2_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return MemoryGameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemoryGameQuery(get_called_class());
    }

    public function beforeSave($insert) {
        $this->afp2_user_id = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }
}
