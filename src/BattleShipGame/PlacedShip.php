<?php

namespace App\BattleShipGame;


use App\BattleShipGame\Grid\Square;


class PlacedShip extends Ship
{
    /**
     * @var Orientation
     */
    private $orientation;

    /**
     * PlacedShip constructor.
     * @param Ship $ship
     * @param Orientation $orientation
     * @throws Exception\ShipCreatedWithInvalidSize
     */
    public function __construct(Ship $ship, Orientation $orientation)
    {
        parent::__construct($ship->name, $ship->numberOfSquares);

        $this->orientation = $orientation;
    }

    /**
     * @return Orientation
     */
    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }

    /**
     * @param Square $startSquare
     * @return bool
     * @throws Exception\SquareCreatedWithInvalidHorizontalId
     * @throws Exception\SquareCreatedWithInvalidVerticalId
     * @throws Exception\OrientationCreatedWithInvalidOrientation
     */
    public function occupiesSquare(Square $startSquare): bool
    {
        return in_array($startSquare, parent::occupiedSquares($startSquare, $this->orientation));
    }
}