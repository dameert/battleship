<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\Artefacts\Orientation;
use App\BattleShipGame\Artefacts\ResultOfAttack;
use App\BattleShipGame\Artefacts\ResultOfAttackService;

class GridService
{
    /**
     * @var ResultOfAttackService
     */
    private $resultOfAttackService;

    public function __construct()
    {
        $this->resultOfAttackService = new ResultOfAttackService();
    }

    /**
     * @return PreparingGrid
     * @throws \App\BattleShipGame\Exception\GridCreatedWithInvalidSize
     */
    public function createPreparingGrid(): PreparingGrid
    {
        return new PreparingGrid();
    }

    /**
     * @param int $number
     * @param string $letter
     * @return Square
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId
     */
    public function square(int $number, string $letter): Square
    {
        return new Square(
            new HorizontalSquarePosition($number),
            new VerticalSquarePosition($letter)
        );
    }

    /**
     * @return \App\BattleShipGame\Artefacts\ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function hit(): ResultOfAttack
    {
        return $this->resultOfAttackService->hit();
    }

    /**
     * @return \App\BattleShipGame\Artefacts\ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult]
     */
    public function miss(): ResultOfAttack
    {
        return $this->resultOfAttackService->miss();
    }

    /**
     * @return ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function sunk(): ResultOfAttack
    {
        return $this->resultOfAttackService->sunk();
    }

    /**
     * @return \App\BattleShipGame\Artefacts\ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function fleetDestroyed(): ResultOfAttack
    {
        return $this->resultOfAttackService->fleetDestroyed();
    }
}