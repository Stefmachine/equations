<?php


namespace Stefmachine\Equations\Value;


use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Helper\EqHelper;

class Variable implements EquationValueInterface
{
    protected $id;
    
    public function __construct(string $_id)
    {
        $this->id = $_id;
        
        if(!EqHelper::isValidVariableName($this->id)){
            throw new EquationException("Invalid variable name given '{$this->id}'.");
        }
    }
    
    public function toString(array $_values = array(), array $_options = array()): string
    {
        $value = $this->resolveValue($this->id, $_values);
    
        return $value instanceof Variable && $value->id === $this->id ? $this->id : $value->toString($_values);
    }
    
    public function eval(array $_values = array(), array $_options = array()): float
    {
        $value = $this->resolveValue($this->id, $_values);
        
        if($value instanceof Variable && $value->id === $this->id){
            throw new EquationEvaluationException("Could not evaluate equation. Missing variable value '{$this->id}' in equation: {equation}.", $this, $_values);
        }
    
        return $value->eval($_values, $_options);
    }
    
    private function resolveValue(string $_variable, array $_values, $_visited = array()): EquationValueInterface
    {
        if(array_key_exists($_variable, $_values)){
            if(EqHelper::isValidValue($_values[$_variable])){
                return new Value($_values[$_variable]);
            }
            
            if(EqHelper::isValidVariableName($_values[$_variable])){
                if(!in_array($_values[$_variable], $_visited)){
                    return $this->resolveValue($_values[$_variable], $_values, array_merge($_visited, [$_values[$_variable]]));
                }
            }
        }
        
        return new Variable($_variable);
    }
}