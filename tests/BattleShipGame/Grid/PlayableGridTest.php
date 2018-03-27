<?php

namespace App\Tests\BattleShipGame\Grid;


use App\BattleShipGame\Grid\PlayableGrid;
use App\BattleShipGame\Grid\PreparingGrid;
use App\BattleShipGame\Grid\Square;
use App\BattleShipGame\Artefacts\PlacedShip;
use App\BattleShipGame\Artefacts\ResultOfAttack;
use App\BattleShipGame\Artefacts\Ship;
use App\Tests\DomainTest;

class PlayableGridTest extends DomainTest
{
    /**
     * @var Square
     */
    private $startSquare;

    /**
     * @var Square
     */
    private $nextSquare;

    /**
     * @var \App\BattleShipGame\Artefacts\Ship
     */
    private $ship;

    /**
     * @var PlayableGrid
     */
    private $playableGrid;

    public function setUp(): void
    {
        parent::setUp();
        $this->ship = new Ship("Titanic", 3);
        $this->startSquare = $this->gridService->square(2, 'b');
        $this->nextSquare = $this->startSquare->getNextSquare($this->orientationService->horizontal());

        $grid = new PreparingGrid();
        $grid->addShip($this->ship, $this->startSquare, $this->orientationService->vertical());
        $grid->addShip($this->ship, $this->nextSquare, $this->orientationService->vertical());

        $this->playableGrid = $grid->getPlayableGrid();
    }

    public function testHitAttack(): void
    {
        $attack = $this->playableGrid->attack($this->startSquare);

        $this->assertEquals($this->resultOfAttackService->hit(), $attack, "The attack should hit the ship, but another result is produced");
    }

    public function testMissAttack(): void
    {
        $freeSquare = $this->nextSquare->getNextSquare($this->orientationService->horizontal());
        $attack = $this->playableGrid->attack($freeSquare);

        $this->assertEquals($this->resultOfAttackService->miss(), $attack, "The attack should miss the ship, but another result is produced");
    }

    public function testShipSunkAttack(): void
    {
        $attack = $attack = $this->sinkShip($this->startSquare);
        $this->assertEquals($this->resultOfAttackService->sunk(), $attack, "The attack should sink the ship, but another result is produced");
    }

    public function testAllShipsSunkAttack(): void
    {
        $this->sinkShip($this->startSquare);
        $attack = $this->sinkShip($this->nextSquare);

        $this->assertEquals($this->resultOfAttackService->fleetDestroyed(), $attack, "The attack should destroy the fleet, but another result is produced");
    }

    private function sinkShip(Square $startSquare): ResultOfAttack
    {
        $squaresOfShip = $this->ship->calculateOccupiedSquares($startSquare, $this->orientationService->vertical());
        $attack = null;
        foreach ($squaresOfShip as $square) {
            $attack = $this->playableGrid->attack($square);
        }

        return $attack;
    }
}