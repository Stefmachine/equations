<?php


namespace Stefmachine\Equations;


use Stefmachine\Equations\Operator\Division;
use Stefmachine\Equations\Operator\Modulo;
use Stefmachine\Equations\Operator\Multiplication;
use Stefmachine\Equations\Operator\Subtraction;
use Stefmachine\Equations\Operator\Addition;
use Stefmachine\Equations\Value\Reserved\Pi;

class Eq
{
    public static function plus($_addendA, $_addendB): Addition
    {
        return new Addition($_addendA, $_addendB);
    }
    
    public static function minus($_minuend, $_subtrahend): Subtraction
    {
        return new Subtraction($_minuend, $_subtrahend);
    }
    
    public static function multiply($_factorA, $_factorB): Multiplication
    {
        return new Multiplication($_factorA, $_factorB);
    }
    
    public static function divide($_dividend, $_divisor): Division
    {
        return new Division($_dividend, $_divisor);
    }
    
    public static function modulo($_dividend, $_divisor): Modulo
    {
        return new Modulo($_dividend, $_divisor);
    }
    
    
    // Reserved values
    public static function pi(): Pi
    {
        return new Pi();
    }
}