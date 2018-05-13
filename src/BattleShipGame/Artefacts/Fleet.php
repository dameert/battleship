<?php

namespace App\BattleShipGame\Artefacts;


use App\BattleShipGame\Exception\AddedZeroShipsToFleet;
use App\BattleShipGame\Exception\FleetIsEmpty;
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
     * @return bool
     */
    public function hasShip(Ship $ship): bool
    {
        return array_search($ship, $this->ships);
    }

    /**
     * @param Ship $ship
     * @throws ShipTakenFromFleetThatIsNotPartOfThatFleet
     * @throws \App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero
     */
    public function removeShip(Ship $ship): void
    {
        $key = array_search($ship, $this->ships);

        if (false === $key) {
            echo "\n Ship: $ship is no part of this fleet anymore";
            throw new ShipTakenFromFleetThatIsNotPartOfThatFleet();
        }

        $numberOfShips = $this->numberOfShipsByKey[$key];

        if (PositiveInt::zero() != $numberOfShips->previous()) {
            $this->numberOfShipsByKey[$key] = $numberOfShips->previous();
            echo "\n Ship: ($key)$ship has ".$this->numberOfShipsByKey[$key]." left";
        } else {
            echo "\n Ship: ($key)$ship is removed";
            unset($this->numberOfShipsByKey[$key]);
            unset($this->ships[$key]);
            echo "\n remaining ships:";
            foreach ($this->ships as $ship) {
                echo "\n $ship";
            }
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

    /**
     * @return Ship
     * @throws FleetIsEmpty
     */
    public function randomShip(): Ship
    {
        if (empty($this->ships)) {
            throw new FleetIsEmpty();
        }

        echo "\n picking from ships:";
        foreach ($this->ships as $ship) {
            echo "\n $ship";
        }

        return $this->ships[array_rand($this->ships)];
    }

    /**
     * @return bool
     */
    public function isPlaced(): bool
    {
        return [] == $this->ships;
    }
}