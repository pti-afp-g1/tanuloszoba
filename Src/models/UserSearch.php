<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\db\Expression;

class UserSearch extends User {
	
    public $roleName;
	
    public function rules() {
        return [
            [['id'], 'integer'],
            [['username', 'email', 'password', 'roleName'], 'safe'],
        ];
    }
	
    public function scenarios() {
        return Model::scenarios();
    }
	
    public function search($params) {
        $query = User::find();

        //keresési feltételeket itt adhatunk meg

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'username',
                'email',
                'roleName' => [
                    'asc' => ['afp2_auth_assignment.item_name' => SORT_DESC],
                    'desc' => ['afp2_auth_assignment.item_name' => SORT_ASC],
                    'defaultSort' => 'asc',
                    'label' => 'Szerep'
                ]
            ]
        ]);

        $this->load($params);

        $query->joinWith('authAssignment');

        //szűrési feltételeket itt adhatunk meg
		
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password]);

        if (strtolower($this->roleName === 'student')) {
            $query->andFilterWhere(['is', 'afp2_auth_assignment.item_name', new Expression('null')]);
        } else {
            $query->andFilterWhere(['like', 'afp2_auth_assignment.item_name', $this->roleName]);
        }

        return $dataProvider;
    }
}
