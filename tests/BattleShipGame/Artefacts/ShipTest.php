<?php

namespace App\Tests\BattleShipGame\Artefacts;


use App\BattleShipGame\Exception\ShipCreatedWithInvalidSize;
use App\BattleShipGame\Artefacts\Ship;
use App\Tests\DomainTest;

class ShipTest extends DomainTest
{
    /**
     * @var int
     */
    private $minimumNumberOfSquares = 2;

    /**
     * @var int
     */
    private $mediumNumberOfSquares = 3;

    /**
     * @var int
     */
    private $maximumNumberOfSquares = 5;

    public function setUp()
    {
        parent::setUp();

    }

    public function testShipCreationTooSmall(): void
    {
        $this->expectException(ShipCreatedWithInvalidSize::class);

        new \App\BattleShipGame\Artefacts\Ship("Titanic", $this->minimumNumberOfSquares-1);
    }

    public function testShipCreationTooBig(): void
    {
        $this->expectException(ShipCreatedWithInvalidSize::class);

        new \App\BattleShipGame\Artefacts\ship("Titanic", $this->maximumNumberOfSquares+1);
    }

    public function testShipCreation(): void
    {
        $ship = new \App\BattleShipGame\Artefacts\Ship("Titanic", $this->mediumNumberOfSquares);

        $this->assertEquals("Titanic", "$ship", "The ship is not properly converted to string");

        $occupiedSquaresHorizontal = $ship->calculateOccupiedSquares($this->gridService->square(1, "A"), $this->orientationService->horizontal());
        $occupiedSquaresVertical = $ship->calculateOccupiedSquares($this->gridService->square(1, "A"), $this->orientationService->vertical());

        $horizontalSquares = [];
        $verticalSquares = [];

        foreach ([1,2,3] as $number) {
            $horizontalSquares[] = $this->gridService->square($number, "A");
        }

        foreach (["A", "B", "C"] as $letter) {
            $verticalSquares[] = $this->gridService->square(1, $letter);
        }

        $this->assertEquals($horizontalSquares, $occupiedSquaresHorizontal, "The occupied squares for a horizontal ship are not as expected");
        $this->assertEquals($verticalSquares, $occupiedSquaresVertical, "The occupied squares for a vertical ship are not as expected");
    }
}