<?php


namespace Stefmachine\Equations\Operator;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Multiplication implements EquationOperatorInterface
{
    use EvalCatchTrait;
    
    /** @var EquationInterface */
    protected $factorA;
    /** @var EquationInterface */
    protected $factorB;
    
    public function __construct($_factorA, $_factorB)
    {
        $this->factorA = EqHelper::parseValue($_factorA);
        $this->factorB = EqHelper::parseValue($_factorB);
    }
    
    public function toString(array $_values = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->factorA), ' * ', EqHelper::wrap($this->factorB)], $_values);
    }
    
    public function tryEval(array $_values = array()): float
    {
        return $this->factorA->eval($_values) * $this->factorB->eval($_values);
    }
}