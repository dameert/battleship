<?php

namespace App\BattleShipGame\Game;

use App\BattleShipGame\Artefacts\Orientation;
use App\BattleShipGame\Artefacts\OrientationService;
use App\BattleShipGame\Artefacts\Ship;
use App\BattleShipGame\Exception\AddShipToPlayerThatIsNotPartOfTheGame;
use App\BattleShipGame\Exception\AddShipWhileNotInPreparingPhase;
use App\BattleShipGame\Exception\PlayingTurnWhileNotCurrentPlayer;
use App\BattleShipGame\Exception\PlayTurnWhileNotInPlayingPhase;
use App\BattleShipGame\Exception\ShipAddedOnAnotherShip;
use App\BattleShipGame\Exception\ShipAddedOutsideOfGrid;
use App\BattleShipGame\Grid\GridService;
use App\BattleShipGame\Grid\Square;

class BattleshipGame
{
    /**
     * @var Player[]
     */
    private $players = [];

    /**
     * @var Phase
     */
    private $phase;

    /**
     * @var PhaseService
     */
    private $phaseService;

    /**
     * @var GridService
     */
    private $gridService;

    /**
     * @var OrientationService
     */
    private $orientationService;

    /**
     * @var Player
     */
    private $currentPlayer;

    /**
     * @var Player
     */
    private $waitingPlayer;

    /**
     * BattleshipGame constructor.
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     * @throws \App\BattleShipGame\Exception\GridCreatedWithInvalidSize
     */
    public function __construct()
    {
        $this->phaseService = new PhaseService();
        $this->gridService = new GridService();
        $this->orientationService = new OrientationService();

        $this->phase = $this->phaseService->preparing();

        $this->currentPlayer = new Player("Player 1");
        $this->players[] = $this->currentPlayer;
        $this->waitingPlayer = new Player("Computer");
        $this->players[] = $this->waitingPlayer;
    }

    /**
     * @return Player
     */
    public function currentPlayer(): Player
    {
        return $this->currentPlayer;
    }

    /**
     * @return Phase
     */
    public function phase(): Phase
    {
        return $this->phase;
    }

    /**
     * @param Square $squareToAttack
     * @throws PlayTurnWhileNotInPlayingPhase
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     * @throws PlayingTurnWhileNotCurrentPlayer
     */
    public function playTurn(Square $squareToAttack, Player $player)
    {
        if ($this->phaseService->playing() != $this->phase) {
            throw new PlayTurnWhileNotInPlayingPhase();
        }

        if ($this->currentPlayer != $player) {
            throw new PlayingTurnWhileNotCurrentPlayer();
        }

        //Todo play turn

        $this->transitionForPlayingPhase();
    }

    /**
     * @param Ship $ship
     * @param Square $startSquare
     * @param Orientation $orientation
     * @param Player $player
     * @throws AddShipWhileNotInPreparingPhase
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     * @throws \App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero
     * @throws \App\BattleShipGame\Exception\ShipAddedOnAnotherShip
     * @throws \App\BattleShipGame\Exception\ShipAddedOutsideOfGrid
     * @throws \App\BattleShipGame\Exception\ShipCreatedWithInvalidSize
     * @throws \App\BattleShipGame\Exception\ShipTakenFromFleetThatIsNotPartOfThatFleet
     * @throws AddShipToPlayerThatIsNotPartOfTheGame
     */
    public function addShip(Ship $ship, Square $startSquare, Orientation $orientation, Player $player)
    {
        if ($this->phaseService->preparing() != $this->phase) {
            throw new AddShipWhileNotInPreparingPhase();
        }

        if (!in_array($player, $this->players)) {
            throw new AddShipToPlayerThatIsNotPartOfTheGame();
        }

        $player->addShip($ship, $startSquare, $orientation);

        $this->transitionForPreparingPhase();
    }

    /**
     * @param Player $player
     * @throws AddShipToPlayerThatIsNotPartOfTheGame
     * @throws AddShipWhileNotInPreparingPhase
     * @throws \App\BattleShipGame\Exception\FleetIsEmpty
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     * @throws \App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero
     * @throws \App\BattleShipGame\Exception\ShipCreatedWithInvalidSize
     * @throws \App\BattleShipGame\Exception\ShipTakenFromFleetThatIsNotPartOfThatFleet
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId
     */
    public function addShipsAtRandom(Player $player)
    {
        echo "\n hello";
        while (!$player->isReadyToPlay()) {
            $ship = $player->randomShipFromFleet();
            echo "\n NEW LOOP with ship: $ship";
            $shipNotPlaced = true;

            $square = $this->getSquare();
            $orientation = $this->orientationService->vertical()q;
            do {
                try {
                    $this->addShip($ship, $square, $orientation, $player);
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
    }

    /**
     * @param int $maxRecursion
     * @return Square
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId
     * @throws \App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId
     */
    private function getSquare($maxRecursion = 10): Square
    {
        $hardcodedLetterPositions = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        try {
            $square = $this->gridService->square(rand(1, 10), $hardcodedLetterPositions[rand(0,9)]);
        } catch (\Exception $e) {
            $square = false;
            if (0 === $maxRecursion) {
                return $this->gridService->square(1,'A');
            }
        }

        return $square ? $square : $this->getSquare($maxRecursion - 1);
    }

    /**
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     */
    private function transitionForPreparingPhase(): void
    {
        foreach ($this->players as $player) {
            if (!$player->isReadyToPlay()) {
                return;
            }
        }

        $this->phase = $this->phaseService->playing();
    }

    private function transitionForPlayingPhase(): void
    {
        //TODO check if player has won
        if (false) {
            $this->phase = $this->phaseService->end();
            //TODO Announce winning
        }

        $waitingPlayer = $this->waitingPlayer;
        $this->waitingPlayer = $this->currentPlayer;
        $this->currentPlayer =$waitingPlayer;
    }
}