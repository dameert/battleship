<?php

namespace App\BattleShipGame\Artefacts;

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

    /**
     * @return Orientation
     * @throws \App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation
     */
    public function randomOrientation(): Orientation
    {
        return new Orientation(Orientation::RANDOM);
    }
}