<?php

namespace App\Tests\BattleShipGame\Artefacts;

use App\BattleShipGame\Exception\InvalidPhaseCreated;
use App\BattleShipGame\Game\Phase;
use App\Tests\DomainTest;

class PhaseTest extends DomainTest
{
    /**
     * @var string
     */
    private $invalidState;

    public function setUp()
    {
        parent::setUp();
        $this->invalidState = "asdflkj";
    }

    public function testPhaseCreationFailed(): void
    {
        $this->expectException(InvalidPhaseCreated::class);

        new Phase($this->invalidState);
    }

    public function testPreparingPhaseCreation(): void
    {
        $phase = new Phase(Phase::PREPARING);

        $this->assertEquals($this->phaseService->preparing(),$phase, "Could not create HIT result of attack.");
    }

    public function testPlayingPhaseCreation(): void
    {
        $phase = new Phase(Phase::PLAYING);

        $this->assertEquals($this->phaseService->playing(),$phase, "Could not create MISS result of attack.");
    }

    public function testEndPhaseCreation(): void
    {
        $phase = new Phase(Phase::END);

        $this->assertEquals($this->phaseService->end(), $phase, "Could not create SUNK result of attack.");
    }
}