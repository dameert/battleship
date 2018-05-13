<?php

namespace App\BattleShipGame\Values;


use App\BattleShipGame\Exception\PositiveIntCannotBeSmallerThenZero;

class PositiveInt
{
    /**
     * @var int
     */
    private $amount;

    /**
     * PositiveInt constructor.
     * @param int $amount
     * @throws PositiveIntCannotBeSmallerThenZero
     */
    public function __construct(int $amount)
    {
        if (0 > $amount) {
            throw new PositiveIntCannotBeSmallerThenZero();
        }

        $this->amount = $amount;
    }

    /**
     * @return PositiveInt
     * @throws PositiveIntCannotBeSmallerThenZero
     */
    public function next(): PositiveInt
    {
        return new PositiveInt($this->amount + 1);
    }

    /**
     * @return PositiveInt
     * @throws PositiveIntCannotBeSmallerThenZero
     */
    public function previous(): PositiveInt
    {
        try {
            return new PositiveInt($this->amount - 1);
        } catch (PositiveIntCannotBeSmallerThenZero $positiveIntCannotBeSmallerThenZero) {
            return new PositiveInt(0);
        }
    }

    /**
     * @return PositiveInt
     * @throws PositiveIntCannotBeSmallerThenZero
     */
    public static function zero(): PositiveInt
    {
        return new PositiveInt(0);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->amount;
    }
}