<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Parentheses implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $subject;
    
    public function __construct(EquationInterface $_subject)
    {
        $this->subject = $_subject;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return "({$this->subject->toString($_values, $_options)})";
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->subject->eval($_values, $_options);
    }
}