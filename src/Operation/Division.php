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
    
    public function __construct(EquationInterface $_dividend, EquationInterface $_divisor)
    {
        $this->dividend = $_dividend;
        $this->divisor = $_divisor;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->dividend), ' / ', EqHelper::wrap($this->divisor)], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        $divisor = $this->divisor->eval($_values, $_options);
        
        if($divisor == 0){
            throw new EquationEvaluationException("Attempted to divide by zero in equation: {equation}", $this, $_values);
        }
        
        return $this->dividend->eval($_values, $_options) / $divisor;
    }
}