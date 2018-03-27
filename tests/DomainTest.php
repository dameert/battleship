<?php

namespace App\Tests;

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
     * @var \App\BattleShipGame\Artefacts\OrientationService
     */
    protected $orientationService;

    /**
     * @var \App\BattleShipGame\Artefacts\ResultOfAttackService
     */
    protected $resultOfAttackService;

    /**
     * @var \App\BattleShipGame\Artefacts\StateOfSquareService
     */
    protected $stateOfSquareService;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->gridService = new GridService();
        $this->orientationService = new OrientationService();
        $this->resultOfAttackService = new ResultOfAttackService();
        $this->stateOfSquareService = new StateOfSquareService();
    }
}