<?php

namespace App\BattleShipGame;


use App\BattleShipGame\Grid\Square;


class PlacedShip extends Ship
{

    /**
     * @var Square[]
     */
    private $occupiedSquares;

    /**
     * PlacedShip constructor.
     * @param Ship $ship
     * @param Square $startSquare
     * @param Orientation $orientation
     * @throws Exception\OrientationCreatedWithInvalidOrientation
     * @throws Exception\ShipCreatedWithInvalidSize
     * @throws Exception\SquareCreatedWithInvalidHorizontalId
     * @throws Exception\SquareCreatedWithInvalidVerticalId
     */
    public function __construct(Ship $ship, Square $startSquare, Orientation $orientation)
    {
        parent::__construct($ship->name, $ship->numberOfSquares);

        $this->occupiedSquares = parent::occupiedSquares($startSquare, $orientation);
    }

    /**
     * @param Square $square
     * @return bool
     */
    public function occupiesSquare(Square $square): bool
    {
        return in_array($square, $this->occupiedSquares);
    }
}