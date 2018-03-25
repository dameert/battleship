<?php

namespace App\Tests;

use App\BattleShipGame\Grid\GridService;
use App\BattleShipGame\OrientationService;
use App\BattleShipGame\ResultOfAttackService;
use App\BattleShipGame\StateOfSquareService;
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