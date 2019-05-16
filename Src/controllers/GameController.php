<?php

namespace app\controllers;

use app\components\Game;
use app\models\LexicalGame;
use app\models\MemoryGame;
use thamtech\uuid\helpers\UuidHelper;
use yii\filters\AccessControl;
use yii\web\Controller;
use \yii;

class GameController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }


}
