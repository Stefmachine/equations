<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Ceiling implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $value;
    
    public function __construct($_value)
    {
        $this->value = EqHelper::parseValue($_value);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join(['⌈', EqHelper::wrap($this->getValue()), '⌉'], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return ceil($this->getValue()->eval($_values, $_options));
    }
    
    protected function getValue(): EquationInterface
    {
        return $this->value;
    }
}