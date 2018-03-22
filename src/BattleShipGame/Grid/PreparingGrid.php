<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\Exception\GridCreatedWithInvalidSize;
use App\BattleShipGame\Exception\ShipAddedOnAnotherShip;
use App\BattleShipGame\Exception\ShipAddedOutsideOfGrid;
use App\BattleShipGame\Orientation;
use App\BattleShipGame\PlacedShip;
use App\BattleShipGame\Ship;

class PreparingGrid extends Grid
{
    /**
     * Grid constructor.
     * @param int $size
     * @throws GridCreatedWithInvalidSize
     */
    public function __construct(int $size = 10)
    {
        if ($size < 10 || $size > 26){
            throw new GridCreatedWithInvalidSize();
        }
        $letters = range('A',  chr(ord('A')+$size));

        $gridSquares = [];

        foreach ($letters as $letter){
            $squares = array_map(
                function (int $number) use ($letter){
                    return $this->gridService->square($number, $letter);
                },
                range(1,$size)
            );
            $gridSquares = array_merge($gridSquares, $squares);
        }

        parent::__construct($gridSquares, []);
    }

    /**
     * @return PlayableGrid
     */
    public function getPlayableGrid(): PlayableGrid
    {
        return new PlayableGrid($this->squares, $this->placedShips);
    }

    /**
     * @param Ship $ship
     * @param Square $startSquare
     * @param Orientation $orientation
     * @throws ShipAddedOnAnotherShip
     * @throws ShipAddedOutsideOfGrid
     * @throws \App\BattleShipGame\Exception\ShipCreatedWithInvalidSize
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     */
    public function addShip(Ship $ship, Square $startSquare, Orientation $orientation): void
    {
        $occupiedSquares = $ship->occupiedSquares($startSquare, $orientation);

        foreach ($occupiedSquares as $occupiedSquare){
            if (!$this->hasSquare($occupiedSquare)){
                throw new ShipAddedOutsideOfGrid();
            }
            if ($this->squareHasShip($occupiedSquare)){
                throw new ShipAddedOnAnotherShip();
            }
        }

        $this->placedShips[] = new PlacedShip($ship, $orientation);
    }
}