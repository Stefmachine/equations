<?php


namespace Stefmachine\Equations\Value;


class AliasValue implements EquationValueInterface
{
    /** @var string */
    protected $alias;
    /** @var float */
    protected $value;
    
    public function __construct(string $_alias, float $_value)
    {
        $this->alias = $_alias;
        $this->value = $_value;
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        return $this->alias;
    }
    
    public function eval(array $_values = array(), array $_options = array()): float
    {
        return $this->value;
    }
}