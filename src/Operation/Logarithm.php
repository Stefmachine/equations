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
    
    public function __construct($_base, $_argument)
    {
        $this->base = EqHelper::parseValue($_base);
        $this->argument = EqHelper::parseValue($_argument);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join(['log', EqHelper::wrap($this->getBase(), false),' ', EqHelper::wrap($this->getArgument())], $_values, $_options);
    }
    
    public function tryEval(array $_values = array(), array $_options = array()): float
    {
        $base = $this->getBase()->eval($_values, $_options);
        
        if($base <= 0){
            throw new EquationEvaluationException("Attempted to evaluate logarithm with base lesser than or equal to 0.", $this, $_values);
        }
        
        return log($this->getArgument()->eval($_values, $_options), $base);
    }
    
    protected function getBase(): EquationInterface
    {
        return $this->base;
    }
    
    protected function getArgument(): EquationInterface
    {
        return $this->argument;
    }
}