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

    public function actionLexical() {
        $game = new Game(6);
        $deck = $game->getPublicDeck();
        $uuid = UuidHelper::uuid();
        $_SESSION[$uuid] = $game->getSecretDeck();
        return $this->render('lexical', ['deck' => $deck, 'uuid' => $uuid]);
    }


}
