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
    
    public function __construct(EquationInterface $_value)
    {
        $this->value = $_value;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->value), '!'], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        $value = $this->value->eval($_values, $_options);
        
        $total = 1;
        while ($value != 0){
            if($value < 0){
                throw new EquationEvaluationException("Attempted to evaluate factorial of negative number in equation: {equation}", $this, $_values);
            }
            
            $total *= $value;
            $value--;
        }
        
        return $total;
    }
}