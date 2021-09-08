<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EvalCatchTrait;
use Stefmachine\Equations\Helper\EqHelper;

class Addition implements EquationOperationInterface
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
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->getAddendA()), ' + ', EqHelper::wrap($this->getAddendB())], $_values, $_options);
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->getAddendA()->eval($_values, $_options) + $this->getAddendB()->eval($_values, $_options);
    }
    
    protected function getAddendA(): EquationInterface
    {
        return $this->addendA;
    }
    
    protected function getAddendB(): EquationInterface
    {
        return $this->addendB;
    }
}