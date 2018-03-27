<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\PlacedShip;
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
     */
    public function attack(Square $attackedSquare): ResultOfAttack
    {
        $this->attackedSquares[] = $attackedSquare;
        $attackedShip = $this->squareHasShip($attackedSquare);

        if ($attackedShip){
            return $this->resultOfAttackOnShip($attackedShip);
        }

        return $this->gridService->miss();
    }

    private function resultOfAttackOnShip(PlacedShip $ship): ResultOfAttack
    {
        if ($this->isShipFloating($ship)) {
            return $this->gridService->hit();
        }

        if ($this->isFleetFloating()) {
            return $this->gridService->sunk();
        }

        return $this->gridService->fleetDestroyed();
    }

    /**
     * @param PlacedShip $ship
     * @return bool
     */
    private function isShipFloating(PlacedShip $ship): bool
    {
        foreach ($ship->occupiedSquares() as $square) {
            if (!$this->squareIsAttacked($square)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    private function isFleetFloating(): bool
    {
        foreach ($this->placedShips as $placedShip) {
            if ($this->isShipFloating($placedShip)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Square $square
     * @return bool
     */
    private function squareIsAttacked(Square $square): bool
    {
        return in_array($square, $this->attackedSquares);
    }
}