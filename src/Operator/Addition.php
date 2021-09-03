<?php


namespace Stefmachine\Equations\Operator;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EvalCatchTrait;
use Stefmachine\Equations\Helper\EqHelper;

class Addition implements EquationOperatorInterface
{
    use EvalCatchTrait;
    
    /** @var EquationInterface */
    protected $addendA;
    /** @var EquationInterface */
    protected $addendB;
    
    public function __construct($_addendA, $_addendB)
    {
        $this->addendA = EqHelper::parseValue($_addendA);
        $this->addendB = EqHelper::parseValue($_addendB);
    }
    
    public function toString(array $_values = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->addendA), ' + ', EqHelper::wrap($this->addendB)], $_values);
    }
    
    public function tryEval(array $_values = array()): float
    {
        return $this->addendA->eval($_values) + $this->addendB->eval($_values);
    }
}