<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Subtraction implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $minuend;
    protected $subtrahend;
    
    public function __construct(EquationInterface $_minuend, EquationInterface $_subtrahend)
    {
        $this->minuend = $_minuend;
        $this->subtrahend = $_subtrahend;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->minuend), ' - ', EqHelper::wrap($this->subtrahend)], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->minuend->eval($_values, $_options) - $this->subtrahend->eval($_values, $_options);
    }
}