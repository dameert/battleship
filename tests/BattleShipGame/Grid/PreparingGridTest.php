<?php

namespace App\Tests\BattleShipGame\Grid;


use App\BattleShipGame\Exception\GridCreatedWithInvalidSize;
use App\BattleShipGame\Exception\ShipAddedOnAnotherShip;
use App\BattleShipGame\Exception\ShipAddedOutsideOfGrid;
use App\BattleShipGame\Grid\PreparingGrid;
use App\BattleShipGame\Artefacts\Ship;
use App\Tests\DomainTest;

class PreparingGridTest extends DomainTest
{
    /**
     * @var int
     */
    private $minimumSize = 10;

    /**
     * @var int
     */
    private $maximumSize = 26;

    public function testPreparingGridCreationFailedTooSmall(): void
    {
        $this->expectException(GridCreatedWithInvalidSize::class);

        new PreparingGrid($this->minimumSize-1);
    }

    public function testPreparingGridCreationFailedTooBig(): void
    {
        $this->expectException(GridCreatedWithInvalidSize::class);

        new PreparingGrid($this->maximumSize+1);
    }

    public function testAddingAShipOnAnExistingShip(): void
    {
        $ship = new Ship("Titanic", 3);
        $startSquare = $this->gridService->square(2, 'b');

        $grid = new PreparingGrid();
        $grid->addShip($ship, $startSquare, $this->orientationService->horizontal());

        $this->expectException(ShipAddedOnAnotherShip::class);
        $grid->addShip($ship, $startSquare, $this->orientationService->vertical());
    }

    public function testAddingMultipleShips(): void
    {
        $ship = new Ship("Titanic", 2);
        $startSquare = $this->gridService->square(2, 'b');
        $nextSquare = $startSquare->getNextSquare($this->orientationService->horizontal());
        $grid = new PreparingGrid();

        $grid->addShip($ship, $startSquare, $this->orientationService->vertical());
        $grid->addShip($ship, $nextSquare, $this->orientationService->vertical());

        //TODO add assertion

    }

    public function testAddingAShipOutsideOfGrid(): void
    {
        $ship = new Ship("Titanic", 3);
        $lastSquare = $this->gridService->square(10, 'j');
        $grid = new PreparingGrid();

        $this->expectException(ShipAddedOutsideOfGrid::class);
        $grid->addShip($ship, $lastSquare, $this->orientationService->horizontal());
    }
}