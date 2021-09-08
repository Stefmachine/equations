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
    
    public function __construct($_factorA, $_factorB)
    {
        $this->factorA = EqHelper::parseValue($_factorA);
        $this->factorB = EqHelper::parseValue($_factorB);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->getFactorA()), ' * ', EqHelper::wrap($this->getFactorB())], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->getFactorA()->eval($_values, $_options) * $this->getFactorB()->eval($_values, $_options);
    }
    
    protected function getFactorA(): EquationInterface
    {
        return $this->factorA;
    }
    
    protected function getFactorB(): EquationInterface
    {
        return $this->factorB;
    }
}