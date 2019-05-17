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
	
    public function search($params)
    {
        $query = CardPair::find();

        //feltételek helye

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        //szűrő feltételek helye
        $query->andFilterWhere([
            'id' => $this->id,
            'afp2_category_id' => $this->afp2_category_id,
            'afp2_user_id' => $this->afp2_user_id,
        ]);

        $query->andFilterWhere(['like', 'card1', $this->card1])
            ->andFilterWhere(['like', 'card2', $this->card2]);

        return $dataProvider;
    }
}
