<?php

namespace App\Taxes;

use Psr\Log\LoggerInterface;

/**
 * Class Calculator.
 */
class Calculator
{
    protected $logger;

    protected $tva;

    /**
     * Class constructor.
     */
    public function __construct(LoggerInterface $logger, float $tva = 20.0)
    {
        $this->logger = $logger;
        $this->tva = $tva;
    }

    /**
     * Calcualte TVA
     */
    function calculate(int $amount)
    {
        return $amount * $this->tva / 100;
    }
}
