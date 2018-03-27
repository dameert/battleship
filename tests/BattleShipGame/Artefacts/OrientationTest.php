<?php

namespace App\Tests\BattleShipGame\Artefacts;


use App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation;
use App\BattleShipGame\Artefacts\Orientation;
use App\Tests\DomainTest;

class OrientationTest extends DomainTest
{
    /**
     * @var string
     */
    private $invalidOrientation = "asdfsaf";

    public function testOrientationCreationFailed(): void
    {
        $this->expectException(OrientationCreatedWithInvalidOrientation::class);

        new \App\BattleShipGame\Artefacts\Orientation($this->invalidOrientation);
    }

    public function testHorizontalOrientationCreation(): void
    {
        $orientation = new \App\BattleShipGame\Artefacts\Orientation(Orientation::HORIZONTAL);

        $this->assertEquals($this->orientationService->horizontal(), $orientation, "Could not create HORIZONTAL orientation.");
    }

    public function testVerticalOrientationCreation(): void
    {
        $orientation = new Orientation(\App\BattleShipGame\Artefacts\Orientation::VERTICAL);

        $this->assertEquals($this->orientationService->vertical(), $orientation, "Could not create VERTICAL orientation.");
    }
}