<?php

namespace App\BattleShipGame;


use App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation;

class Orientation
{
    /**
     * @var string
     */
    private $orientation;

    const HORIZONTAL = 'horizontal';
    const VERTICAL = 'vertical';
    protected const ORIENTATIONS = [self::HORIZONTAL, self::VERTICAL];

    /**
     * Orientation constructor.
     * @param string $orientation
     * @throws OrientationCreatedWithInvalidOrientation
     */
    public function __construct(string $orientation)
    {
        if (!in_array($orientation, self::ORIENTATIONS)){
            throw new OrientationCreatedWithInvalidOrientation();
        }
        $this->orientation = $orientation;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->orientation;
    }
}