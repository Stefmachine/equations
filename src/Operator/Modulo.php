<?php


namespace Stefmachine\Equations\Operator;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Modulo implements EquationOperatorInterface
{
    use EvalCatchTrait;
    
    /** @var EquationInterface */
    protected $dividend;
    /** @var EquationInterface */
    protected $divisor;
    
    public function __construct($_dividend, $_divisor)
    {
        $this->dividend = EqHelper::parseValue($_dividend);
        $this->divisor = EqHelper::parseValue($_divisor);
    }
    
    public function toString(array $_values = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->dividend), ' mod ', EqHelper::wrap($this->divisor)], $_values);
    }
    
    public function tryEval(array $_values = array()): float
    {
        return $this->dividend->eval($_values) % $this->divisor->eval($_values);
    }
}