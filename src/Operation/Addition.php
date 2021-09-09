<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EvalCatchTrait;
use Stefmachine\Equations\Helper\EqHelper;

class Addition implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $addends;
    
    public function __construct(EquationInterface $_addendA, EquationInterface $_addendB, EquationInterface ...$_otherAddends)
    {
        $this->addends = array_merge([$_addendA, $_addendB], $_otherAddends);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return array_reduce($this->addends, function(string $_string, EquationInterface $_equation) use(&$_values, &$_options){
            return ($_string !== '' ? "{$_string} + " : '') . EqHelper::wrap($_equation)->toString($_values, $_options);
        }, '');
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return array_reduce($this->addends, function(float $_sum, EquationInterface $_equation) use(&$_values, &$_options){
            return $_sum + $_equation->eval($_values, $_options);
        }, 0);
    }
}