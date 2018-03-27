<?php

namespace App\BattleShipGame\Artefacts;


use App\BattleShipGame\Artefacts\ResultOfAttack;
use App\BattleShipGame\Exception\ResultOfAttackCreatedWithInvalidResult;
use App\BattleShipGame\Exception\StatusOfSquareCreatedWithInvalidState;

class StateOfSquare extends ResultOfAttack
{
    const NOT_ATTACKED = 'not attacked';

    /**
     * StateOfSquare constructor.
     * @param string $result
     * @throws StatusOfSquareCreatedWithInvalidState
     */
    public function __construct(string $result)
    {
        try{
            parent::__construct($result);
        }catch (ResultOfAttackCreatedWithInvalidResult $attackCreatedWithInvalidResult){
            if(self::NOT_ATTACKED !== $result){
                throw new StatusOfSquareCreatedWithInvalidState();
            }
            $this->result = $result;
        }
    }
}