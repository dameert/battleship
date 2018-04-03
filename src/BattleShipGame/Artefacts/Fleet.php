<?php

namespace App\BattleShipGame\Artefacts;


use App\BattleShipGame\Exception\AddedZeroShipsToFleet;
use App\BattleShipGame\Exception\ShipTakenFromFleetThatIsNotPartOfThatFleet;
use App\BattleShipGame\Values\PositiveInt;

class Fleet
{
    /**
     * @var Ship[]
     */
    protected $ships = [];

    /**
     * @var PositiveInt[]
     */
    protected $numberOfShipsByKey = [];

    /**
     * @param Ship $ship
     * @throws ShipTakenFromFleetThatIsNotPartOfThatFleet
     * @throws \App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero
     */
    public function removeShip(Ship $ship): void
    {
        $key = array_search($ship, $this->ships);

        if (false === $key) {
            throw new ShipTakenFromFleetThatIsNotPartOfThatFleet();
        }

        $numberOfShips = $this->numberOfShipsByKey[$key];

        if (PositiveInt::zero() != $numberOfShips->previous()) {
            $this->numberOfShipsByKey[$key] = $numberOfShips->previous();
        } else {
            unset($this->numberOfShipsByKey[$key]);
            unset($this->ships[$key]);
        }

    }

    /**
     * @param Ship $ship
     * @param PositiveInt $numberOfShipsByKey
     * @throws \App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero
     * @throws AddedZeroShipsToFleet
     */
    public function addShips(Ship $ship, PositiveInt $numberOfShipsByKey)
    {
        if (PositiveInt::zero() == $numberOfShipsByKey) {
            throw new AddedZeroShipsToFleet();
        }

        $this->ships[] = $ship;
        $this->numberOfShipsByKey[] = $numberOfShipsByKey;
    }
}