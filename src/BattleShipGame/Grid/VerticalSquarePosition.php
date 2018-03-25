<?php

namespace App\BattleShipGame\Grid;


use App\BattleShipGame\Exception\SquareCreatedWithInvalidVerticalId;

class VerticalSquarePosition
{
    /**
     * @var string
     */
    private $id;

    /**
     * VerticalSquarePosition constructor.
     * @param string $id
     * @throws SquareCreatedWithInvalidVerticalId
     */
    public function __construct(string $id)
    {
        if (0 === strlen($id) || strlen($id) > 1){
            throw new SquareCreatedWithInvalidVerticalId();
        }

        $upperCaseLetter = strtoupper($id);
        $alphabetPosition = ord($upperCaseLetter) - ord('A');

        if ($alphabetPosition < 0 || $alphabetPosition > 9){
            throw new SquareCreatedWithInvalidVerticalId();
        }

        $this->id = $upperCaseLetter;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }

    /**
     * @return VerticalSquarePosition
     * @throws SquareCreatedWithInvalidVerticalId
     */
    public function nextVerticalSquarePosition()
    {
        $nextId = chr(1 + ord($this->id));
        return new VerticalSquarePosition($nextId);
    }
}