<?php

namespace app\components;

use app\models\CardPair;
use yii\base\InvalidArgumentException;
use yii\db\Expression;


class Game {

    protected $secretDeck = [];
    protected $publicDeck = [];
    protected $cardPairs;

    public function __construct($size = 6) {
        /*$this->setCardPairs($size);
        $this->setSecretDeck();
        $this->shuffleDeck();
        $this->setPublicDeck();*/
    }

    public function getDeck() {
        return $this->cardPairs;
    }

    public function getSecretDeck() {
        return $this->secretDeck;
    }

    public function getPublicDeck() {
        return $this->publicDeck;
    }

    public static function checkResult($list, $identifier) {
        $secretDeck = static::getSecretDeckFromSession($identifier);
        if($secretDeck[$list[0]]['id'] === $secretDeck[$list[1]]['id']){
            return 'success';
        }
        return 'fail';
    }

    private static function getSecretDeckFromSession($identifier) {
        return $_SESSION[$identifier];
    }
}