<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\Exception\SquareCreatedWithInvalidHorizontalId;

class HorizontalSquarePosition
{
    /**
     * @var int
     */
    private $id;

    /**
     * HorizontalSquarePosition constructor.
     * @param int $id
     * @throws SquareCreatedWithInvalidHorizontalId
     */
    public function __construct(int $id)
    {
        if ($id < 1 || $id > 10){
            throw new SquareCreatedWithInvalidHorizontalId();
        }

        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }

    /**
     * @return HorizontalSquarePosition
     * @throws SquareCreatedWithInvalidHorizontalId
     */
    public function nextHorizontalSquarePosition()
    {
        return new HorizontalSquarePosition(1 + $this->id);
    }
}