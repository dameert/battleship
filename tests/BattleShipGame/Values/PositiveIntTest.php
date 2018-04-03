<?php

namespace App\Tests\BattleShipGame\Values;


use App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero;
use App\BattleShipGame\Values\PositiveInt;
use App\Tests\DomainTest;

class PositiveIntTest extends DomainTest
{
    public function testNegativeNumberFailure()
    {
        $this->expectException(PositiveIntCannotBeSmallerThenZero::class);

        new PositiveInt(-2);
    }

    public function testPositiveIntCreation()
    {
        $zero = new PositiveInt(0);
        $one = new PositiveInt(1);

        $this->assertEquals($one, $zero->next(), "Expected one as next positive int for zero");
        $this->assertEquals($zero, $zero->previous(), "Expected zero as previous positive int for zero");
    }
}