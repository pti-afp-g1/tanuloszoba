<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CardPair;

class CardPairSearch extends CardPair
{
    public function rules()
    {
        return [
            [['id', 'afp2_category_id', 'afp2_user_id'], 'integer'],
            [['card1', 'card2'], 'safe'],
        ];
    }	
	
    public function scenarios()
    {
        return Model::scenarios();
    }
}
