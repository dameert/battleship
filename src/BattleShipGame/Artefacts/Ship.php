<?php

namespace App\BattleShipGame\Artefacts;


use App\BattleShipGame\Exception;
use App\BattleShipGame\Exception\ShipCreatedWithInvalidSize;
use App\BattleShipGame\Grid\Square;
use App\BattleShipGame\Artefacts\Orientation;

class Ship
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $numberOfSquares;

    /**
     * Ship constructor.
     * @param string $name
     * @param int $numberOfSquares
     * @throws ShipCreatedWithInvalidSize
     */
    public function __construct(string $name, int $numberOfSquares)
    {
        if ($numberOfSquares < 2 || $numberOfSquares > 5){
            throw new ShipCreatedWithInvalidSize();
        }

        $this->name = $name;
        $this->numberOfSquares = $numberOfSquares;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @param Square $startSquare
     * @param Orientation $orientation
     * @return array
     * @throws Exception\SquareCreatedWithInvalidHorizontalId
     * @throws Exception\SquareCreatedWithInvalidVerticalId
     * @throws Exception\OrientationCreatedWithInvalidOrientation
     */
    public function calculateOccupiedSquares(Square $startSquare, Orientation $orientation): array
    {
        $squares = [$startSquare];

        for ($i = 1; $i < $this->numberOfSquares; $i++){
            /** @var Square $previousSquare */
            $previousSquare = end($squares);
            $squares[] = $previousSquare->getNextSquare($orientation);
        }

        return $squares;
    }
}