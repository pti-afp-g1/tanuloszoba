<?php

namespace app\models;

class CategoryQuery extends \yii\db\ActiveQuery
{
    public function all($db = null)
    {
        return parent::all($db);
    }
}
