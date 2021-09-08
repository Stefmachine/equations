<?php


namespace Stefmachine\EquationsTests\Mock;


use Stefmachine\Equations\Operation\EquationOperationInterface;

class EquationOperationMock implements EquationOperationInterface
{
    protected $eval;
    protected $string;
    
    public function __construct(float $_eval, string $_string)
    {
        $this->eval = $_eval;
        $this->string = $_string;
    }
    
    public static function mock(float $_eval, ?string $_string = null): EquationOperationInterface
    {
        return new EquationOperationMock($_eval, $_string ?? (string)$_eval);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return $this->string;
    }
    
    public function eval(array $_values = array(), array $_options = array()): float
    {
        return $this->eval;
    }
}