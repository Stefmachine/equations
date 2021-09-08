<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EvalCatchTrait;
use Stefmachine\Equations\Helper\EqHelper;

class Addition implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $addendA;
    protected $addendB;
    
    public function __construct(EquationInterface $_addendA, EquationInterface $_addendB)
    {
        $this->addendA = $_addendA;
        $this->addendB = $_addendB;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->addendA), ' + ', EqHelper::wrap($this->addendB)], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->addendA->eval($_values, $_options) + $this->addendB->eval($_values, $_options);
    }
}