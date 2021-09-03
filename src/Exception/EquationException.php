<?php


namespace Stefmachine\Equations\Exception;


use RuntimeException;
use Stefmachine\Equations\EquationInterface;

class EquationException extends RuntimeException
{
    /** @var EquationInterface|null */
    protected $equation;
    /** @var array */
    protected $value;
    /** @var string */
    protected $originalMessage;
    
    public function __construct(string $_message, ?EquationInterface $_equation = null, array $_values = array())
    {
        $this->originalMessage = $_message;
        $this->equation = $_equation;
        $this->values = $_values;
        
        parent::__construct($this->getContextMessage());
    }
    
    public function getValues(): array
    {
        return $this->values;
    }
    
    public function getEquation(): ?EquationInterface
    {
        return $this->equation;
    }
    
    public static function refit(EquationException $_exception, EquationInterface $_equation): EquationException
    {
        $_exception->equation = $_equation;
        $_exception->message = $_exception->getContextMessage();
        return $_exception;
    }
    
    protected function getContextMessage(): string
    {
        return strtr($this->originalMessage, [
            '{equation}' => $this->equation ? $this->equation->toString($this->values) : ''
        ]);
    }
}