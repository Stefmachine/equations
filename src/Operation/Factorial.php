<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Factorial implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $value;
    
    public function __construct($_value)
    {
        $this->value = EqHelper::parseValue($_value);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->getValue()), '!'], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        $value = $this->getValue()->eval($_values, $_options);
        
        if($value == 0){
            return 1;
        }
        
        if($value < 0){
            throw new EquationEvaluationException("Attempted to evaluate factorial of negative number in equation: {equation}", $this, $_values);
        }
        
        return $value * (new Factorial($value - 1))->eval($_values, $_options);
    }
    
    protected function getValue(): EquationInterface
    {
        return $this->value;
    }
}