<?php

namespace App\BattleShipGame\Game;


use App\BattleShipGame\Artefacts\OrientationService;
use App\BattleShipGame\Grid\GridService;
use App\BattleShipGame\Grid\Square;

class RandomPreparationService
{
    /**
     * @var OrientationService
     */
    private $orientationService;

    /**
     * @var GridService
     */
    private $gridService;

    /**
     * RandomPreparationService constructor.
     * @param BattleshipGame $game
     */
    public function __construct()
    {
        $this->orientationService = new OrientationService();
        $this->gridService = new GridService();
    }

    /**
     * @param Player $player
     * @throws \App\BattleShipGame\Exception\FleetIsEmpty
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     */
    public function addShip(Player $player)
    {
        $ship = $player->randomShipFromFleet();
        $orientation = $this->orientationService->randomOrientation();
        $square = $this->randomSquare($player);

        do {
            try {
                $this->game->addShip($ship, $square, $orientation, $player);
            } catch (ShipAddedOnAnotherShip $e) {
                echo "\n Ship on other ship";
                throw $e;
                continue;
            } catch (ShipAddedOutsideOfGrid $e) {
                echo "\n Ship outside grid";
                throw $e;
                continue;
            }

            $shipNotPlaced = false;
        } while ($shipNotPlaced);
    }

    /**
     * @param Player $player
     */
    public function addAllShips(Player $player, BattleshipGame $game)
    {
        while (!$player->isReadyToPlay()) {
            $this->addShip($player);
        }
    }

    private function randomSquare(Player $player): Square
    {
        $number = $player->maxNumberOnGrid();
        $letter = $player->maxLetterOnGrid();
    }
}