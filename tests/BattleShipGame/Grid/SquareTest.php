<?php

namespace App\Tests\BattleShipGame\Grid;


use App\BattleShipGame\Grid\HorizontalSquarePosition;
use App\BattleShipGame\Grid\Square;
use App\BattleShipGame\Grid\VerticalSquarePosition;
use App\Tests\DomainTest;

class SquareTest extends DomainTest
{
    /**
     * @var HorizontalSquarePosition
     */
    private $horizontalSquarePosition;

    /**
     * @var VerticalSquarePosition
     */
    private $verticalSquarePosition;

    public function setUp(): void
    {
        parent::setUp();
        $this->horizontalSquarePosition = new HorizontalSquarePosition(2);
        $this->verticalSquarePosition = new VerticalSquarePosition('b');

    }

    public function testSquareCreation(): void
    {
        $square = new Square($this->horizontalSquarePosition, $this->verticalSquarePosition);

        $this->assertEquals($this->gridService->square(2, 'b'), $square);
    }

    public function testNextSquare(): void
    {
        $square = $this->gridService->square(2, 'b');
        $nextHorizontalSquare = $this->gridService->square(3, 'b');
        $nextVerticalSquare = $this->gridService->square(2, 'c');

        $this->assertEquals($nextHorizontalSquare, $square->getNextSquare($this->orientationService->horizontal()), "The next horizontal square is not as expected");
        $this->assertEquals($nextVerticalSquare, $square->getNextSquare($this->orientationService->vertical()), "The next vertical square is not as expected");
    }
}