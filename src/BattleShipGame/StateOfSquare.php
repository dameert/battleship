<?php

namespace App\BattleShipGame;


use App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult;

class StateOfSquare extends ResultOfAttack
{
    const NOT_ATTACKED = 'not attacked';

    /**
     * StateOfSquare constructor.
     * @param string $result
     * @throws ResultOfAttackCreatedWithInvalidResult
     */
    public function __construct(string $result)
    {
        try{
            parent::__construct($result);
        }catch (ResultOfAttackCreatedWithInvalidResult $attackCreatedWithInvalidResult){
            if(self::NOT_ATTACKED !== $result){
                throw $attackCreatedWithInvalidResult;
            }
            $this->result = $result;
        }
    }
}