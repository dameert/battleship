<?php

namespace App\Tests\BattleShipGame\Grid;


use App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId;
use App\BattleShipGame\Grid\HorizontalSquarePosition;
use App\Tests\DomainTest;

class HorizontalSquarePositionTest extends DomainTest
{
    /**
     * @var int
     */
    private $minimumId = 1;
    /**
     * @var int
     */
    private $maximumId = 10;

    public function testVerticalSquarePositionCreationFailedWithEmptyString(): void
    {
        $this->expectException(SquareCreatedWithInvalidHorizontalId::class);

        new HorizontalSquarePosition($this->minimumId-1);
    }

    public function testVerticalSquarePositionCreationFailedWithWord(): void
    {
        $this->expectException(SquareCreatedWithInvalidHorizontalId::class);

        new HorizontalSquarePosition($this->maximumId+1);
    }

    public function testVerticalSquarePositionCreation(): void
    {
        $position = new HorizontalSquarePosition(4);

        $this->assertEquals("4", "$position", "The horizontal position has not been created as expected");
    }

    public function testNextHorizontalSquarePosition(): void
    {
        $position = new HorizontalSquarePosition(4);
        $nextPosition = new HorizontalSquarePosition(5);

        $this->assertEquals($nextPosition, $position->nextHorizontalSquarePosition());
    }
}