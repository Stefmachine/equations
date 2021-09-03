<?php


namespace Stefmachine\Equations\Value;


use Stefmachine\Equations\Helper\EqHelper;

class VariableValueMap
{
    /** @var array<string, float|string> */
    protected $map;
    
    protected function __construct(array $_map)
    {
        $this->map = $_map;
    }
    
    public static function fromArray(array $_map): VariableValueMap
    {
        return new VariableValueMap($_map);
    }
    
    public function get(string $_variable): EquationValueInterface
    {
        if(array_key_exists($_variable, $this->map)){
            if(EqHelper::isValidValue($this->map[$_variable])){
                return new Value($this->map[$_variable]);
            }
            
            if(EqHelper::isValidVariableName($this->map[$_variable])){
                return new Variable($this->map[$_variable]);
            }
        }
    
        return new Variable($_variable);
    }
}