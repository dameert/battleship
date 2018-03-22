<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\PlacedShip;

class Grid
{
    /**
     * @var Square[]
     */
    protected $squares = [];

    /**
     * @var PlacedShip[]
     */
    protected $placedShips = [];

    /**
     * @var GridService
     */
    protected $gridService;

    /**
     * Grid constructor.
     * @param array $squares
     * @param array $placedShips
     */
    public function __construct(array $squares, array $placedShips)
    {
        $this->squares = $squares;
        $this->placedShips = $placedShips;
        $this->gridService = new GridService();
    }

    /**
     * @param Square $square
     * @return bool
     */
    protected function hasSquare(Square $square): bool
    {
        return in_array($square, $this->squares);
    }

    /**
     * @param Square $square
     * @return bool
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId
     */
    protected function squareHasShip(Square $square): bool
    {
        foreach ($this->placedShips as $placedShip){
            if ($placedShip->occupiesSquare($square)) {
                return true;
            }
        }
        return false;
    }
}