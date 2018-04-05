<?php

namespace App\BattleShipGame\Artefacts;


use App\BattleShipGame\Values\PositiveInt;

class StandardFleet extends Fleet
{
    public function __construct()
    {
        $ships = [
            new Ship("Carrier", 5),
            new Ship("Battleship", 4),
            new Ship("Cruiser", 3),
            new Ship("Submarine", 3),
            new Ship("Destroyer", 2),
            ];

        foreach ($ships as $count => $ship) {
            $this->addShips($ship, new PositiveInt($count + 1));
        }
    }
}