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

    private function setCardPairs($size) {
        if ($size % 2 !== 0) {
            throw new InvalidArgumentException('The size of the deck must be even!');
        }
        $this->cardPairs = CardPair::find()
            ->orderBy(new Expression('rand()'))
            ->limit($size)->all();
    }

    private function setSecretDeck() {
        foreach ($this->cardPairs as $cardPair) {
            $pushable1 = [
                'id' => $cardPair->id,
                'img' => $cardPair->card1
            ];
            $pushable2 = [
                'id' => $cardPair->id,
                'img' => $cardPair->card2
            ];

            array_push($this->secretDeck, $pushable1);
            array_push($this->secretDeck, $pushable2);
        }
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

    private function shuffleDeck() {
        shuffle($this->secretDeck);
    }
}