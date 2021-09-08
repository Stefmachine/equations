<?php


namespace Stefmachine\EquationsTests\Mock;


use Stefmachine\Equations\EquationInterface;

class EquationMockForwardTester implements EquationInterface
{
    public $values;
    public $options;
    
    protected $value;
    protected function __construct(float $_value)
    {
        $this->value = $_value;
    }
    
    public static function mock(float $_value): EquationInterface
    {
        return new EquationMockForwardTester($_value);
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        $this->values = $_values;
        $this->options = $_options;
        return (string)$this->value;
    }
    
    public function eval(array $_values = array(), array $_options = array()): float
    {
        $this->values = $_values;
        $this->options = $_options;
        return $this->value;
    }
}