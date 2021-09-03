<?php


namespace Stefmachine\Equations\Value;


use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Helper\EqHelper;
use Throwable;

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
    
    public function toString(array $_values = array()): string
    {
        $map = VariableValueMap::fromArray($_values);
        $value = $map->get($this->id);
    
        return Variable::boxCircularEvaluation($this->id, function() use ($value, $_values){
            return $value->toString($_values);
        }, $this->id);
    }
    
    public function eval(array $_values = array()): float
    {
        $map = VariableValueMap::fromArray($_values);
        $value = $map->get($this->id);
        
        if($value instanceof Variable && $value->id === $this->id){
            throw new EquationEvaluationException("Could not evaluate equation. Missing variable value '{$this->id}' in equation: {equation}.", $this, $_values);
        }
    
        return Variable::boxCircularEvaluation($this->id, function() use ($value, $_values){
            return $value->eval($_values);
        }, new EquationEvaluationException("Circular variable definition found on variable '{$this->id}' in equation: {equation}"));
    }
    
    private static $variableCircularIndex = array();
    private static function boxCircularEvaluation(string $_id, callable $_callable, $_onFailValue)
    {
        if(array_key_exists($_id, Variable::$variableCircularIndex) && Variable::$variableCircularIndex[$_id]){
            if($_onFailValue instanceof EquationException){
                throw $_onFailValue;
            }
            
            return $_onFailValue;
        }
        
        Variable::$variableCircularIndex[$_id] = true;
        $result = call_user_func($_callable);
        Variable::$variableCircularIndex[$_id] = false;
        return $result;
    }
}