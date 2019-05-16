<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

class CategorySearch extends Category
{
    public function rules()
    {
        return [
            [['id', 'afp2_user_id'], 'integer'],
            [['title'], 'safe'],
        ];
    }
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
}