<?php


namespace Stefmachine\Equations\Helper;


use LogicException;
use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;

trait EvalCatchTrait
{
    public function eval(array $_values = array()): float
    {
        try{
            return $this->tryEval($_values);
        }
        catch(EquationEvaluationException $ex){
            if(!$this instanceof EquationInterface){
                throw $ex;
            }
            
            throw EquationEvaluationException::refit($ex, $this);
        }
    }
    
    /**
     * @param array $_values
     * @return float
     *
     * @throws EquationEvaluationException
     */
    abstract protected function tryEval(array $_values = array()): float;
}