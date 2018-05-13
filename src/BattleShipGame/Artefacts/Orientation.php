<?php

namespace App\BattleShipGame\Artefacts;


use App\BattleShipGame\Exception\OrientationCreatedWithInvalidOrientation;

class Orientation
{
    /**
     * @var string
     */
    private $orientation;

    const HORIZONTAL = 'horizontal';
    const VERTICAL = 'vertical';
    const RANDOM = 'random';
    protected const ORIENTATIONS = [self::HORIZONTAL, self::VERTICAL];

    /**
     * Orientation constructor.
     * @param string $orientation
     * @throws OrientationCreatedWithInvalidOrientation
     */
    public function __construct(string $orientation)
    {
        if ($orientation === self::RANDOM) {
            $orientation = self::ORIENTATIONS[rand(0,1)];
        }

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