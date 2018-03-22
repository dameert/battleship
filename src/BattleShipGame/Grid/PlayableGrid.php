<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\ResultOfAttack;

class PlayableGrid extends Grid
{
    /**
     * @var Square[]
     */
    private $attackedSquares = [];

    /**
     * @param Square $attackedSquare
     * @return ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId
     */
    public function attack(Square $attackedSquare): ResultOfAttack
    {
        $this->attackedSquares[] = $attackedSquare;

        if ($this->squareHasShip($attackedSquare)){
            return $this->gridService->hit();
        }

        return $this->gridService->miss();
    }
}