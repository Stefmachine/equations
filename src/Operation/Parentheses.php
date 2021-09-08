<?php


namespace Stefmachine\Equations\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Helper\EqHelper;
use Stefmachine\Equations\Helper\EvalCatchTrait;

class Parentheses implements EquationOperationInterface
{
    use EvalCatchTrait;
    
    protected $subject;
    
    public function __construct($_subject)
    {
        $this->subject = EqHelper::parseValue($_subject);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return "({$this->getSubject()->toString($_values)})";
    }
    
    protected function tryEval(array $_values = array(), array $_options = array()): float
    {
        return $this->getSubject()->eval($_values, $_options);
    }
    
    protected function getSubject(): EquationInterface
    {
        return $this->subject;
    }
}