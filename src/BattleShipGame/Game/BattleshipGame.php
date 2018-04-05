<?php

namespace App\BattleShipGame\Game;


use App\BattleShipGame\Artefacts\Fleet;
use App\BattleShipGame\Artefacts\StandardFleet;
use App\BattleShipGame\Grid\Grid;
use App\BattleShipGame\Grid\GridService;

class BattleshipGame
{
    /**
     * @var Grid[]
     */
    private $grids = [];

    /**
     * @var Fleet[]
     */
    private $fleets = [];

    /**
     * @var string[]
     */
    private $players = ["Player 1", "Computer"];

    /**
     * @var Phase
     */
    private $phase;

    /**
     * @var PhaseService
     */
    private $phaseService;

    /**
     * BattleshipGame constructor.
     * @throws \App\BattleShipGame\Exception\GridCreatedWithInvalidSize
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     */
    public function __construct()
    {
        $gridService = new GridService();
        $this->phaseService = new PhaseService();

        $this->phase = $this->phaseService->preparing();

        foreach ($this->players as $player) {
            $this->grids[] = $gridService->createPreparingGrid();
            $this->fleets[] = new StandardFleet();
        }
    }
}