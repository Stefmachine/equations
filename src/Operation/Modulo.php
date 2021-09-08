<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Modulo implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $dividend;
    protected $divisor;
    
    public function __construct($_dividend, $_divisor)
    {
        $this->dividend = EqHelper::parseValue($_dividend);
        $this->divisor = EqHelper::parseValue($_divisor);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->getDividend()), ' mod ', EqHelper::wrap($this->getDivisor())], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->getDividend()->eval($_values, $_options) % $this->getDivisor()->eval($_values, $_options);
    }
    
    protected function getDividend(): EquationInterface
    {
        return $this->dividend;
    }
    
    protected function getDivisor(): EquationInterface
    {
        return $this->divisor;
    }
}