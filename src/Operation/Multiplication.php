<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Multiplication implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $factorA;
    protected $factorB;
    
    public function __construct(EquationInterface $_factorA, EquationInterface $_factorB)
    {
        $this->factorA = $_factorA;
        $this->factorB = $_factorB;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->factorA), ' * ', EqHelper::wrap($this->factorB)], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->factorA->eval($_values, $_options) * $this->factorB->eval($_values, $_options);
    }
}