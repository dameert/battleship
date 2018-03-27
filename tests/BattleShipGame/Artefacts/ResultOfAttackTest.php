<?php

namespace App\Tests\BattleShipGame\Artefacts;

use App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult;
use App\BattleShipGame\Exception\StatusOfSquareCreatedWithInvalidState;
use App\BattleShipGame\Artefacts\ResultOfAttack;
use App\BattleShipGame\Artefacts\StateOfSquare;
use App\Tests\DomainTest;

class ResultOfAttackTest extends DomainTest
{
    /**
     * @var string
     */
    private $invalidState;

    public function setUp()
    {
        parent::setUp();
        $this->invalidState = \App\BattleShipGame\Artefacts\StateOfSquare::NOT_ATTACKED;
    }

    public function testResultOfAttackCreationFailed(): void
    {
        $this->expectException(ResultOfAttackCreatedWithInvalidResult::class);

        new \App\BattleShipGame\Artefacts\ResultOfAttack($this->invalidState);
    }

    public function testHitResultOfAttackCreation(): void
    {
        $state = new ResultOfAttack(ResultOfAttack::HIT);

        $this->assertEquals($this->resultOfAttackService->hit(),$state, "Could not create HIT result of attack.");
    }

    public function testMissResultOfAttackCreation(): void
    {
        $state = new ResultOfAttack(\App\BattleShipGame\Artefacts\ResultOfAttack::MISS);

        $this->assertEquals($this->resultOfAttackService->miss(),$state, "Could not create MISS result of attack.");
    }

    public function testSunkResultOfAttackCreation(): void
    {
        $state = new \App\BattleShipGame\Artefacts\ResultOfAttack(\App\BattleShipGame\Artefacts\ResultOfAttack::SUNK);

        $this->assertEquals($this->resultOfAttackService->sunk(), $state, "Could not create SUNK result of attack.");
    }

    public function testFleetDestroyedResultOfAttackCreation(): void
    {
        $state = new ResultOfAttack(\App\BattleShipGame\Artefacts\ResultOfAttack::FLEET_DESTROYED);

        $this->assertEquals($this->resultOfAttackService->fleetDestroyed(), $state, "Could not create FLEET DESTROYED result of attack.");
    }
}