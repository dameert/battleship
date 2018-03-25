<?php

namespace App\BattleShipGame;

class StateOfSquareService
{
    /**
     * @return StateOfSquare
     * @throws Exception\StatusOfSquareCreatedWithInvalidState
     */
    public function hit(): StateOfSquare
    {
        return new StateOfSquare(StateOfSquare::HIT);
    }

    /**
     * @return StateOfSquare
     * @throws Exception\StatusOfSquareCreatedWithInvalidState
     */
    public function miss(): StateOfSquare
    {
        return new StateOfSquare(StateOfSquare::MISS);
    }

    /**
     * @return StateOfSquare
     * @throws Exception\StatusOfSquareCreatedWithInvalidState
     */
    public function notAttacked(): StateOfSquare
    {
        return new StateOfSquare(StateOfSquare::NOT_ATTACKED);
    }
}