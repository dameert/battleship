<?php

namespace App\Tests\BattleShipGame;

use App\BattleShipGame\Exception\StatusOfSquareCreatedWithInvalidState;
use App\BattleShipGame\StateOfSquare;
use App\Tests\DomainTest;

class StateOfSquareTest extends DomainTest
{
    /**
     * @var string
     */
    private $invalidState = "adssadf";

    public function testStateOfSquareCreationFailed(): void
    {
        $this->expectException(StatusOfSquareCreatedWithInvalidState::class);

        new StateOfSquare($this->invalidState);
    }

    public function testHitStateOfSquareCreation(): void
    {
        $state = new StateOfSquare(StateOfSquare::HIT);

        $this->assertEquals($this->stateOfSquareService->hit(),$state, "Could not create HIT state of a square.");
    }

    public function testMissStateOfSquareCreation(): void
    {
        $state = new StateOfSquare(StateOfSquare::MISS);

        $this->assertEquals($this->stateOfSquareService->miss(),$state, "Could not create MISS state of a square.");
    }
    public function testNotAttackedStateOfSquareCreation(): void
    {
        $state = new StateOfSquare(StateOfSquare::NOT_ATTACKED);

        $this->assertEquals($this->stateOfSquareService->notAttacked(),$state, "Could not create NOT ATTACKED state of a square.");
    }

}