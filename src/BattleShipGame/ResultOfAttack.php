<?php

namespace App\BattleShipGame;


use App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult;

class ResultOfAttack
{
    /**
     * @var string
     */
    protected $result;

    const HIT = 'hit';
    const MISS = 'miss';
    const SUNK = 'sunk';
    const FLEET_DESTROYED = 'fleet destroyed';
    protected const RESULTS = [self::HIT, self::MISS, self::SUNK, self::FLEET_DESTROYED];

    /**
     * ResultOfAttack constructor.
     * @param string $result
     * @throws ResultOfAttackCreatedWithInvalidResult
     */
    public function __construct(string $result)
    {
        if (!in_array($result, self::RESULTS)){
            throw new ResultOfAttackCreatedWithInvalidResult();
        }

        $this->result = $result;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->result;
    }
}