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
    protected const RESULTS = [self::HIT, self::MISS];

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