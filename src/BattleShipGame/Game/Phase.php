<?php

namespace App\BattleShipGame\Game;


use App\BattleShipGame\Exception\InvalidPhaseCreated;

class Phase
{
    /**
     * @var string
     */
    private $phase;

    const PREPARING = 'Preparing';
    const PLAYING = 'Playing';
    const END = 'End';

    protected const PHASES = [self::PREPARING, self::PLAYING, self::END];

    /**
     * Phase constructor.
     * @param string $phase
     * @throws InvalidPhaseCreated
     */
    public function __construct(string $phase)
    {
        if (!in_array($phase, self::PHASES)){
            throw new InvalidPhaseCreated();
        }

        $this->phase = $phase;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->phase;
    }
}