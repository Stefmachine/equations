<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Subtraction implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $minuend;
    protected $subtrahend;
    
    public function __construct($_minuend, $_subtrahend)
    {
        $this->minuend = EqHelper::parseValue($_minuend);
        $this->subtrahend = EqHelper::parseValue($_subtrahend);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->getMinuend()), ' - ', EqHelper::wrap($this->getSubtrahend())], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->getMinuend()->eval($_values, $_options) - $this->getSubtrahend()->eval($_values, $_options);
    }
    
    protected function getMinuend(): EquationInterface
    {
        return $this->minuend;
    }
    
    protected function getSubtrahend(): EquationInterface
    {
        return $this->subtrahend;
    }
}