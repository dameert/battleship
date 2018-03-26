<?php

namespace App\Tests\BattleShipGame\Grid;


use App\BattleShipGame\Grid\PlayableGrid;
use App\BattleShipGame\Grid\PreparingGrid;
use App\BattleShipGame\Ship;
use App\Tests\DomainTest;

class PlayableGridTest extends DomainTest
{
    public function setUp(): void
    {
        parent::setUp();
        $ship = new Ship("Titanic", 3);
        $startSquare = $this->gridService->square(2, 'b');
        $nextStartSquare = $startSquare->getNextSquare($this->orientationService->horizontal());

        $grid = new PreparingGrid();
        $grid->addShip($ship, $startSquare, $this->orientationService->vertical());
        $grid->addShip($ship, $nextStartSquare, $this->orientationService->vertical());

        $playableGrid = $grid->getPlayableGrid();
        $this->assertInstanceOf(PlayableGrid::class, $playableGrid, "The playable grid is not created as expected.");
    }

//    public function testHitAttack(): void
//    {
//    }
//
//    public function testMissAttack(): void
//    {
//    }
//
//    public function testShipSunkAttack(): void
//    {
//    }
//
//    public function testAllShipsSunkAttack(): void
//    {
//    }
}