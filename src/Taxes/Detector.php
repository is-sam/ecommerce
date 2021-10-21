<?php

namespace App\Taxes;

/**
 * Class Detector.
 */
class Detector
{
    protected $minimum;

    /**
     * Class constructor.
     */
    public function __construct($minimum = 100)
    {
        $this->minimum = $minimum;
    }

    /**
     * Detect amount
     */
    public function detect(float $amount): bool
    {
        return $amount >= $this->minimum;
    }
}
