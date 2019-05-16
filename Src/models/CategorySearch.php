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
        return Model::scenarios();
    }
	
    public function search($params)
    {
        $query = Category::find();

        //feltételek ide

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) 
            return $dataProvider;
        }

        // szűrés ide
        $query->andFilterWhere([
            'id' => $this->id,
            'afp2_user_id' => $this->afp2_user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
