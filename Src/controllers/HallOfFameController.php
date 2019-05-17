<?php

namespace app\controllers;

use app\models\LexicalGame;
use app\models\MemoryGame;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class HallOfFameController extends Controller {

    public function actionIndex() {
        $query1 = LexicalGame::find();
        $dataProvider1 = new ActiveDataProvider([
            'query' => $query1,
            'sort' => false
        ]);

        $query1->orderBy([
            'resolved' => SORT_ASC,
            'error' => SORT_DESC
        ]);

        $query2 = MemoryGame::find();
        $dataProvider2 = new ActiveDataProvider([
            'query' => $query2,
            'sort' => false
        ]);

        $query2->orderBy([
            'resolved' => SORT_ASC
        ]);

        return $this->render('index', ['dataProvider1' => $dataProvider1, 'dataProvider2' => $dataProvider2]);
    }

}
