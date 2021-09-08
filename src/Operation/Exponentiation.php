<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Exponentiation implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $base;
    protected $exponent;
    
    public function __construct($_base, $_exponent)
    {
        $this->base = EqHelper::parseValue($_base);
        $this->exponent = EqHelper::parseValue($_exponent);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->getBase()), ' ^ ', EqHelper::wrap($this->getExponent())], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        $exponent = $this->getExponent()->eval($_values, $_options);
        $base = $this->getBase()->eval($_values, $_options);
        
        if($exponent > 0 && $exponent < 1 && $base < 0){
            throw new EquationEvaluationException("Attempted to evaluate root of negative number in equation: {equation}", $this, $_values);
        }
        
        if($exponent <= 0 && $base == 0){
            throw new EquationEvaluationException("Attempted to evaluate 0 ^ {$exponent} in equation: {equation}", $this, $_values);
        }
        
        return $base ** $exponent;
    }
    
    protected function getBase(): EquationInterface
    {
        return $this->base;
    }
    
    protected function getExponent(): EquationInterface
    {
        return $this->exponent;
    }
}