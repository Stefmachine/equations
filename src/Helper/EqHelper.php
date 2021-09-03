<?php


namespace Stefmachine\Equations\Helper;


use InvalidArgumentException;
use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operator\Parentheses;
use Stefmachine\Equations\Value\Value;
use Stefmachine\Equations\Value\EquationValueInterface;
use Stefmachine\Equations\Value\Variable;

final class EqHelper
{
    private function __construct(){}
    
    /**
     * @param EquationInterface|numeric|numeric-string|string|null $_value
     * @return EquationInterface
     */
    public static function parseValue($_value): EquationInterface
    {
        if($_value instanceof EquationInterface){
            return $_value;
        }
        
        if(EqHelper::isValidValue($_value)){
            return new Value($_value);
        }
        
        if(EqHelper::isValidVariableName($_value)){
            return new Variable($_value);
        }
    
        throw new EquationException("Expected value to be an instance of ".EquationInterface::class.", a numeric, a numeric string, a string representing a variable name or null. Got '".gettype($_value)."'.");
    }
    
    public static function isValidValue($_value): bool
    {
        return is_numeric($_value);
    }
    
    public static function isValidVariableName($_variable): bool
    {
        return is_string($_variable) && preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $_variable);
    }
    
    public static function wrap(EquationInterface $_equation, bool $_skipValues = true): EquationInterface
    {
        return !$_equation instanceof EquationValueInterface || !$_skipValues ? new Parentheses($_equation) : $_equation;
    }
    
    public static function join(array $_parts, array $_values = array()): string
    {
        return implode('', array_map(function($_part) use ($_values){
            if($_part instanceof EquationInterface){
                return $_part->toString($_values);
            }
            else if(is_string($_part)){
                return $_part;
            }
    
            throw new InvalidArgumentException("Expected joined parts to be instances of ".EquationInterface::class." or strings. Got '".gettype($_part)."'.");
        }, $_parts));
    }
}