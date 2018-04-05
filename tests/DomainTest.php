<?php

namespace App\Tests;

use App\BattleShipGame\Game\PhaseService;
use App\BattleShipGame\Grid\GridService;
use App\BattleShipGame\Artefacts\OrientationService;
use App\BattleShipGame\Artefacts\ResultOfAttackService;
use App\BattleShipGame\Artefacts\StateOfSquareService;
use PHPUnit\Framework\TestCase;

class DomainTest extends TestCase
{
    /**
     * @var GridService
     */
    protected $gridService;

    /**
     * @var OrientationService
     */
    protected $orientationService;

    /**
     * @var ResultOfAttackService
     */
    protected $resultOfAttackService;

    /**
     * @var StateOfSquareService
     */
    protected $stateOfSquareService;

    /**
     * @var PhaseService
     */
    protected $phaseService;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->gridService = new GridService();
        $this->orientationService = new OrientationService();
        $this->resultOfAttackService = new ResultOfAttackService();
        $this->stateOfSquareService = new StateOfSquareService();
        $this->phaseService = new PhaseService();
    }
}