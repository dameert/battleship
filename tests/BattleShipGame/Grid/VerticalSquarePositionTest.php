<?php

namespace App\Tests\BattleShipGame\Grid;


use App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId;
use App\BattleShipGame\Grid\VerticalSquarePosition;
use App\Tests\DomainTest;

class VerticalSquarePositionTest extends DomainTest
{
    public function testVerticalSquarePositionCreationFailedWithEmptyString(): void
    {
        $this->expectException(SquareCreatedWithInvalidVerticalId::class);

        new VerticalSquarePosition('');
    }

    public function testVerticalSquarePositionCreationFailedWithWord(): void
    {
        $this->expectException(SquareCreatedWithInvalidVerticalId::class);

        new VerticalSquarePosition('word');
    }

    public function testVerticalSquarePositionCreationFailedWithSymbol(): void
    {
        $this->expectException(SquareCreatedWithInvalidVerticalId::class);

        new VerticalSquarePosition('$');
    }

    public function testVerticalSquarePositionCreationFailedWithNumber(): void
    {
        $this->expectException(SquareCreatedWithInvalidVerticalId::class);

        new VerticalSquarePosition('1');
    }

    public function testVerticalSquarePositionCreation(): void
    {
        $position = new VerticalSquarePosition('g');

        $this->assertEquals("G", "$position", "The vertical position has not been created as expected");
    }

    public function testNextVerticalPosition(): void
    {
        $position = new VerticalSquarePosition('g');
        $nextPosition = new VerticalSquarePosition('h');

        $this->assertEquals($nextPosition, $position->nextVerticalSquarePosition());
    }
}