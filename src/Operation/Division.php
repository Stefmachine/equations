<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Division implements EquationOperationInterface
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
        return EqHelper::join([EqHelper::wrap($this->getDividend()), ' / ', EqHelper::wrap($this->getDivisor())], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        $divisor = $this->getDivisor()->eval($_values, $_options);
        
        if($divisor == 0){
            throw new EquationEvaluationException("Attempted to divide by zero in equation: {equation}", $this, $_values);
        }
        
        return $this->getDividend()->eval($_values, $_options) / $divisor;
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