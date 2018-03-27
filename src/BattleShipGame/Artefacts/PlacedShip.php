<?php

namespace App\BattleShipGame\Artefacts;

use App\BattleShipGame\Exception;
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
     * @param array $occupiedSquares
     * @throws Exception\ShipCreatedWithInvalidSize
     */
    public function __construct(Ship $ship, array $occupiedSquares)
    {
        parent::__construct($ship->name, $ship->numberOfSquares);

        $this->occupiedSquares = $occupiedSquares;
    }

    /**
     * @param Square $square
     * @return bool
     */
    public function occupiesSquare(Square $square): bool
    {
        return in_array($square, $this->occupiedSquares);
    }

    /**
     * @return Square[]
     */
    public function occupiedSquares(): array
    {
        return $this->occupiedSquares;
    }
}