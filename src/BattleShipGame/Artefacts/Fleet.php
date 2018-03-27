<?php

namespace App\BattleShipGame\Artefacts;


use App\BattleShipGame\Exception\ShipTakenFromFleetThatIsNotPartOfThatFleet;

abstract class Fleet
{
    /**
     * @var Ship[]
     */
    protected $ships;

    /**
     * @param Ship $ship
     * @return array
     * @throws ShipTakenFromFleetThatIsNotPartOfThatFleet
     */
    public function getRemainingShips(Ship $ship): array
    {
        $remaining = array_diff($this->ships, [$ship]);
        if ($this->ships == $remaining) {
            throw new ShipTakenFromFleetThatIsNotPartOfThatFleet();
        }

        return $this->ships = $remaining;
    }
}