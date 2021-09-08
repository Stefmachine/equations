<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Tangent implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $value;
    
    public function __construct($_value)
    {
        $this->value = EqHelper::parseValue($_value);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join(['tan', EqHelper::wrap($this->getValue(), false)], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return tan($this->getValue()->eval($_values, $_options));
    }
    
    private function getValue(): EquationInterface
    {
        return $this->value;
    }
}