<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Round implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $value;
    
    public function __construct(EquationInterface $_value)
    {
        $this->value = $_value;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join(['⌊', EqHelper::wrap($this->value), '⌉'], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        // TODO: PHP always round away from zero. Maybe add some rounding options?
        /**
         * There are 6 deterministic rules for rounding:
         *  - Round 1/2 up (1.5 > 2, -1.5 > -1) <-- This is what javascript does
         *  - Round 1/2 down (1.5 > 1, -1.5 > -2)
         *  - Round 1/2 away from 0 (1.5 > 2, -1.5 > -2) <-- This is what php does by default
         *  - Round 1/2 towards 0 (1.5 > 1, -1.5 > -1)
         *  - Round 1/2 to the nearest even (1.5 and 2.5 > 2, -1.5 and -2.5 > -2) <-- Bankers rounding
         *  - Round 1/2 to the nearest uneven (0.5 and 1.5 > 1, -0.5 and -1.5 > -1)
         */
        return round($this->value->eval($_values, $_options));
    }
}