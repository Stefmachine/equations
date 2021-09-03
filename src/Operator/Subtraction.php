<?php


namespace Stefmachine\Equations\Operator;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Subtraction implements EquationOperatorInterface
{
    use EvalCatchTrait;
    
    /** @var EquationInterface */
    protected $minuend;
    /** @var EquationInterface */
    protected $subtrahend;
    
    public function __construct($_minuend, $_subtrahend)
    {
        $this->minuend = EqHelper::parseValue($_minuend);
        $this->subtrahend = EqHelper::parseValue($_subtrahend);
    }
    
    public function toString(array $_values = array()): string
    {
        return EqHelper::join([EqHelper::wrap($this->minuend), ' - ', EqHelper::wrap($this->subtrahend)], $_values);
    }
    
    public function tryEval(array $_values = array()): float
    {
        return $this->minuend->eval($_values) - $this->subtrahend->eval($_values);
    }
}