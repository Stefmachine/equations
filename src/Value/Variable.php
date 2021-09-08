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
        $value = self::getValue($this->id, $_values);
    
        return Variable::boxCircularEvaluation($this->id, function() use ($value, $_values){
            return $value->toString($_values);
        }, $this->id);
    }
    
    public function eval(array $_values = array(), array $_options = array()): float
    {
        $value = self::getValue($this->id, $_values);
        
        if($value instanceof Variable && $value->id === $this->id){
            throw new EquationEvaluationException("Could not evaluate equation. Missing variable value '{$this->id}' in equation: {equation}.", $this, $_values);
        }
    
        return Variable::boxCircularEvaluation($this->id, function() use ($value, &$_values, &$_options){
            return $value->eval($_values, $_options);
        }, new EquationEvaluationException("Circular variable definition found on variable '{$this->id}' in equation: {equation}"));
    }
    
    private static function getValue(string $_variable, array $_values): EquationValueInterface
    {
        if(array_key_exists($_variable, $_values)){
            if(EqHelper::isValidValue($_values[$_variable])){
                return new Value($_values[$_variable]);
            }
            
            if(EqHelper::isValidVariableName($_values[$_variable])){
                return new Variable($_values[$_variable]);
            }
        }
        
        return new Variable($_variable);
    }
    
    private static function boxCircularEvaluation(string $_id, callable $_callable, $_onFailValue)
    {
        static $variableCircularIndex = array();
        
        if(array_key_exists($_id, $variableCircularIndex) && $variableCircularIndex[$_id]){
            if($_onFailValue instanceof EquationException){
                throw $_onFailValue;
            }
            
            return $_onFailValue;
        }
        
        $variableCircularIndex[$_id] = true;
        $result = call_user_func($_callable);
        $variableCircularIndex[$_id] = false;
        return $result;
    }
}