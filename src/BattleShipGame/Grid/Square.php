<?php

namespace App\BattleShipGame\Grid;

use App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId;
use App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId;
use App\BattleShipGame\Orientation;
use App\BattleShipGame\OrientationService;

class Square
{
    /**
     * @var HorizontalSquarePosition
     */
    private $horizontalSquarePosition;

    /**
     * @var VerticalSquarePosition
     */
    private $verticalSquarePosition;


    public function __construct(HorizontalSquarePosition $horizontalSquarePosition, VerticalSquarePosition $verticalSquarePosition)
    {
        $this->horizontalSquarePosition = $horizontalSquarePosition;
        $this->verticalSquarePosition = $verticalSquarePosition;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->horizontalSquarePosition . $this->verticalSquarePosition;
    }

    /**
     * @param Orientation $orientation
     * @return Square
     * @throws SquareCreatedWithInvalidHorizontalId
     * @throws SquareCreatedWithInvalidVerticalId
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     */
    public function getNextSquare(Orientation $orientation): Square
    {
        $orientationService = new OrientationService();

        $nextHorizontal =
            $orientation == $orientationService->horizontal() ?
                $this->horizontalSquarePosition->nextHorizontalSquarePosition() :
                $this->horizontalSquarePosition;

        $nextVertical =
            $orientation == $orientationService->vertical() ?
                $this->verticalSquarePosition->nextVerticalSquarePosition() :
                $this->verticalSquarePosition;

        return new Square($nextHorizontal, $nextVertical);
    }
}