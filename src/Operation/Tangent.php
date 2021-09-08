<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Tangent implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $value;
    
    public function __construct(EquationInterface $_value)
    {
        $this->value = $_value;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join(['tan', EqHelper::wrap($this->value, false)], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return tan($this->value->eval($_values, $_options));
    }
}