<?php

namespace App\Tests\BattleShipGame\Artefacts;


use App\BattleShipGame\Artefacts\Fleet;
use App\BattleShipGame\Artefacts\Ship;
use App\BattleShipGame\Values\PositiveInt;
use App\Tests\DomainTest;

class FleetTest extends DomainTest
{
    public function testFleetCreation()
    {
        $emptyFleet = new Fleet();
        $fleet = new Fleet();
        $ship = new Ship("Destroyer", 2);
        $numberOfShips = new PositiveInt(2);
        $this->assertEquals($emptyFleet, $fleet, "Initialized fleets should to be equal.");

        $fleet->addShips($ship, $numberOfShips);
        $this->assertNotEquals($emptyFleet, $fleet, "Configured fleet should be different from initialized fleet.");

        $fleet->removeShip($ship);
        $this->assertNotEquals($emptyFleet, $fleet, "Removed one of two ships, fleet should not be empty.");

        $fleet->removeShip($ship);
        $this->assertEquals($emptyFleet, $fleet, "Removed two of two ships, fleet should be empty.");
    }
}