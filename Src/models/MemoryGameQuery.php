<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MemoryGame]].
 *
 * @see MemoryGame
 */
class MemoryGameQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemoryGame[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemoryGame|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
