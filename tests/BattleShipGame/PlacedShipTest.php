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
        $this->ship = new Ship("Titanic", $this->mediumNumberOfSquares);

    }

    public function testPlacedShipCreation(): void
    {
        $square = $this->gridService->square(1, 'a');
        $occupiedSquares = $this->ship->calculateOccupiedSquares($square, $this->orientationService->horizontal());
        $placedShip = new PlacedShip($this->ship, $occupiedSquares);

        $this->assertEquals("Titanic", "$placedShip", "The placed ship is not properly converted to string");
        $occupiedSquaresHorizontal = $placedShip->calculateOccupiedSquares($square, $this->orientationService->horizontal());

        $horizontalSquares = [];

        foreach ([1,2,3] as $number) {
            $horizontalSquares[] = $this->gridService->square($number, "A");
        }

        $this->assertEquals($horizontalSquares, $occupiedSquaresHorizontal, "The occupied squares for a horizontal placedShip are not as expected");
    }
}