<?php

namespace app\models;

class UserQuery extends \yii\db\ActiveQuery
{
    public function all($db = null)
    {
        return parent::all($db);
    }	
}
