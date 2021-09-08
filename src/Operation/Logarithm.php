<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Logarithm implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $base;
    protected $argument;
    
    public function __construct(EquationInterface $_base, EquationInterface $_argument)
    {
        $this->base = $_base;
        $this->argument = $_argument;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join(['log', EqHelper::wrap($this->base, false),' ', EqHelper::wrap($this->argument)], $_values, $_options);
    }
    
    public function tryEval(array $_values = array(), array $_options = array()): float
    {
        $base = $this->base->eval($_values, $_options);
        
        if($base <= 0){
            throw new EquationEvaluationException("Attempted to evaluate logarithm with base lesser than or equal to 0.", $this, $_values);
        }
        
        return log($this->argument->eval($_values, $_options), $base);
    }
}