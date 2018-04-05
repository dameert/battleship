<?php

namespace App\BattleShipGame\Game;


class PhaseService
{
    /**
     * @return Phase
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     */
    public function preparing(): Phase
    {
        return new Phase(Phase::PREPARING);
    }


    /**
     * @return Phase
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     */
    public function playing(): Phase
    {
        return new Phase(Phase::PLAYING);
    }

    /**
     * @return Phase
     * @throws \App\BattleShipGame\Exception\InvalidPhaseCreated
     */
    public function end(): Phase
    {
        return new Phase(Phase::END);
    }
}