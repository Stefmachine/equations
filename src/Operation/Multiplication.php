<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Multiplication implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $factors;
    
    public function __construct(EquationInterface $_factorA, EquationInterface $_factorB, EquationInterface ...$_otherFactors)
    {
        $this->factors = array_merge([$_factorA, $_factorB], $_otherFactors);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return array_reduce($this->factors, function(string $_string, EquationInterface $_equation) use(&$_values, &$_options){
            return (!empty($_string) ? "{$_string} * " : '') . EqHelper::wrap($_equation)->toString($_values, $_options);
        }, '');
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return array_reduce($this->factors, function(float $_product, EquationInterface $_equation) use(&$_values, &$_options){
            return $_product * $_equation->eval($_values, $_options);
        }, 1);
    }
}