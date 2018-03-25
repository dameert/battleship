<?php

namespace App\Tests\BattleShipGame;


use App\BattleShipGame\Exception\ShipCreatedWithInvalidSize;
use App\BattleShipGame\PlacedShip;
use App\BattleShipGame\Ship;
use App\Tests\DomainTest;

class PlacedShipTest extends DomainTest
{
    /**
     * @var int
     */
    private $mediumNumberOfSquares = 3;

    /**
     * @var Ship
     */
    private $ship;

    public function setUp()
    {
        parent::setUp();
        $this->ship = new Ship("Titanic", 3);

    }

    public function testPlacedShipCreation(): void
    {
        $placedShip = new PlacedShip($this->ship, $this->orientationService->horizontal());

        $this->assertEquals("Titanic", "$placedShip", "The placed ship is not properly converted to string");
        $this->assertEquals($this->orientationService->horizontal(), $placedShip->getOrientation(), "The orientation of the placed ship is not as expected");

        $occupiedSquaresHorizontal = $placedShip->occupiedSquares($this->gridService->square(1, "A"), $this->orientationService->horizontal());

        $horizontalSquares = [];

        foreach ([1,2,3] as $number) {
            $horizontalSquares[] = $this->gridService->square($number, "A");
        }

        $this->assertEquals($horizontalSquares, $occupiedSquaresHorizontal, "The occupied squares for a horizontal placedShip are not as expected");
    }
}