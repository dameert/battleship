<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\Exception\GridCreatedWithInvalidSize;
use App\BattleShipGame\Exception\ShipAddedOnAnotherShip;
use App\BattleShipGame\Exception\ShipAddedOutsideOfGrid;
use App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId;
use App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId;
use App\BattleShipGame\Artefacts\Orientation;
use App\BattleShipGame\Artefacts\PlacedShip;
use App\BattleShipGame\Artefacts\Ship;

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

        parent::__construct();

        $letters = range('A',  chr(ord('A')+$size-1));
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

        $this->addSquares($gridSquares);

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
        try { //TODO: refactor, a square should not be aware of Grid limits
            $occupiedSquares = $ship->calculateOccupiedSquares($startSquare, $orientation);
        } catch (SquareCreatedWithInvalidHorizontalId $squareCreatedWithInvalidHorizontalId)
        {
            throw new ShipAddedOutsideOfGrid();
        } catch (SquareCreatedWithInvalidVerticalId $squareCreatedWithInvalidVerticalId)
        {
            throw new ShipAddedOutsideOfGrid();
        }

        foreach ($occupiedSquares as $occupiedSquare){
            if (!$this->hasSquare($occupiedSquare)){
                throw new ShipAddedOutsideOfGrid();
            }
            if ($this->squareHasShip($occupiedSquare)){
                throw new ShipAddedOnAnotherShip();
            }
        }

        $this->placedShips[] = new PlacedShip($ship, $occupiedSquares);
    }
}