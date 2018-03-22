<?php

namespace App\BattleShipGame;

class OrientationService
{
    /**
     * @return Orientation
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     */
    public function horizontal(): Orientation
    {
        return new Orientation(Orientation::HORIZONTAL);
    }

    /**
     * @return Orientation
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     */
    public function vertical(): Orientation
    {
        return new Orientation(Orientation::VERTICAL);
    }
}