<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\Orientation;
use App\BattleShipGame\ResultOfAttack;
use App\BattleShipGame\ResultOfAttackService;

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
     * @return ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function hit(): ResultOfAttack
    {
        return $this->resultOfAttackService->hit();
    }

    /**
     * @return ResultOfAttack
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
}