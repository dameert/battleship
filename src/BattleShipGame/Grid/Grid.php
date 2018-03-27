<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\Artefacts\PlacedShip;

class Grid
{
    /**
     * @var Square[]
     */
    protected $squares = [];

    /**
     * @var \App\BattleShipGame\Artefacts\PlacedShip[]
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
    public function __construct(array $squares = [], array $placedShips = [])
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
     * @return PlacedShip|bool
     */
    protected function squareHasShip(Square $square)
    {
        foreach ($this->placedShips as $placedShip){
            if ($placedShip->occupiesSquare($square)) {
                return $placedShip;
            }
        }
        return false;
    }

    /**
     * @param Square[] $squares
     */
    protected function addSquares(array $squares): void
    {
        $this->squares = array_merge($this->squares, $squares);
    }
}