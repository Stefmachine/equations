<?php


namespace Stefmachine\Equations\Operator;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Parentheses implements EquationOperatorInterface
{
    use EvalCatchTrait;
    
    /** @var EquationInterface */
    protected $subject;
    
    public function __construct($_subject)
    {
        $this->subject = EqHelper::parseValue($_subject);
    }
    
    public function toString(array $_values = array()): string
    {
        return "({$this->subject->toString($_values)})";
    }
    
    protected function tryEval(array $_values = array()): float
    {
        return $this->subject->eval($_values);
    }
}