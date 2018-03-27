<?php

namespace App\BattleShipGame;

class ResultOfAttackService
{
    /**
     * @return ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function hit(): ResultOfAttack
    {
        return new ResultOfAttack(ResultOfAttack::HIT);
    }

    /**
     * @return ResultOfAttack
     * @throws \App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function miss(): ResultOfAttack
    {
        return new ResultOfAttack(ResultOfAttack::MISS);
    }

    /**
     * @return ResultOfAttack
     * @throws Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function sunk(): ResultOfAttack
    {
        return new ResultOfAttack(ResultOfAttack::SUNK);
    }

    /**
     * @return ResultOfAttack
     * @throws Exception\ResultOfAttackCreatedWithInvalidResult
     */
    public function fleetDestroyed(): ResultOfAttack
    {
        return new ResultOfAttack(ResultOfAttack::FLEET_DESTROYED);
    }
}