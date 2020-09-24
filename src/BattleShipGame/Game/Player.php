<?php

namespace App\BattleShipGame\Game;


use App\BattleShipGame\Artefacts\Fleet;
use App\BattleShipGame\Artefacts\Orientation;
use App\BattleShipGame\Artefacts\Ship;
use App\BattleShipGame\Artefacts\StandardFleet;
use App\BattleShipGame\Grid\Grid;
use App\BattleShipGame\Grid\GridService;
use App\BattleShipGame\Grid\Square;

class Player
{
    /**
     * @var Grid
     */
    private $grid;

    /**
     * @var Fleet
     */
    private $fleet;

    /**
     * @var string
     */
    private $name;

    /**
     * Player constructor.
     * @param string $name
     * @throws \App\BattleShipGame\Exception\GridCreatedWithInvalidSize
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->fleet = new StandardFleet();
        $this->grid = (new GridService())->createPreparingGrid();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @param Ship $ship
     * @param Square $startSquare
     * @param Orientation $orientation
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     * @throws \App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero
     * @throws \App\BattleShipGame\Exception\ShipAddedOnAnotherShip
     * @throws \App\BattleShipGame\Exception\ShipAddedOutsideOfGrid
     * @throws \App\BattleShipGame\Exception\ShipCreatedWithInvalidSize
     * @throws \App\BattleShipGame\Exception\ShipTakenFromFleetThatIsNotPartOfThatFleet
     */
    public function addShip(Ship $ship, Square $startSquare, Orientation $orientation)
    {
        if ($this->fleet->hasShip($ship)) {
            $this->grid->addShip($ship,$startSquare, $orientation);
            $this->fleet->removeShip($ship);
        }
    }

    /**
     * @return Ship
     * @throws \App\BattleShipGame\Exception\FleetIsEmpty
     */
    public function randomShipFromFleet(): Ship
    {
        return $this->fleet->randomShip();
    }

    /**
     * @return bool
     */
    public function isReadyToPlay(): bool
    {
        return $this->fleet->isPlaced();
    }

    public function maxNumberOnGrid()
    {

    }

    public function maxLetterOnGrid()
    {
        
    }
}