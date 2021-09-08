<?php


namespace Stefmachine\Equations\Helper;


use Stefmachine\Equations\Exception\EquationEvaluationException;

trait EvalCatchTrait
{
    public function eval(array $_values = array(), array $_options = array()): float
    {
        try{
            $result = $this->tryEval($_values, $_options);
        }
        catch(EquationEvaluationException $ex){
            throw EquationEvaluationException::refit($ex, $this);
        }
        
        if(is_nan($result)){
            throw new EquationEvaluationException("Equation evaluation returned NAN in equation: {equation}", $this, $_values);
        }
        
        return $result;
    }
    
    /**
     * @param array<string, string|int> $_values
     * @param array<string, mixed> $_options
     * @return float
     *
     * @throws EquationEvaluationException
     */
    abstract protected function tryEval(array $_values = array(), array $_options = array()): float;
}