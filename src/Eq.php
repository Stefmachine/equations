<?php


namespace Stefmachine\Equations;


use Stefmachine\Equations\Operation\Absolute;
use Stefmachine\Equations\Operation\ArcCosine;
use Stefmachine\Equations\Operation\ArcSine;
use Stefmachine\Equations\Operation\ArcTangent;
use Stefmachine\Equations\Operation\Ceiling;
use Stefmachine\Equations\Operation\Cosine;
use Stefmachine\Equations\Operation\Division;
use Stefmachine\Equations\Operation\Exponentiation;
use Stefmachine\Equations\Operation\Factorial;
use Stefmachine\Equations\Operation\Floor;
use Stefmachine\Equations\Operation\Logarithm;
use Stefmachine\Equations\Operation\Modulo;
use Stefmachine\Equations\Operation\Multiplication;
use Stefmachine\Equations\Operation\Sine;
use Stefmachine\Equations\Operation\Subtraction;
use Stefmachine\Equations\Operation\Addition;
use Stefmachine\Equations\Operation\Tangent;
use Stefmachine\Equations\Value\AliasValue;
use Stefmachine\Equations\Value\Value;
use Stefmachine\Equations\Value\Variable;

class Eq
{
    // OPERATIONS
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
    
    public static function mod($_dividend, $_divisor): Modulo
    {
        return new Modulo($_dividend, $_divisor);
    }
    
    public static function power($_base, $_exponent): Exponentiation
    {
        return new Exponentiation($_base, $_exponent);
    }
    
    public static function root($_rootIndex, $_radicand): Exponentiation
    {
        return new Exponentiation($_radicand, Eq::divide(1, $_rootIndex));
    }
    
    public static function log($_base, $_argument): Logarithm
    {
        return new Logarithm($_base, $_argument);
    }
    
    public static function ln($_argument): Logarithm
    {
        return new Logarithm(Eq::e(), $_argument);
    }
    
    public static function abs($_value): Absolute
    {
        return new Absolute($_value);
    }
    
    public static function floor($_value): Floor
    {
        return new Floor($_value);
    }
    
    public static function round($_value): Floor
    {
        return new Floor(Eq::plus($_value, 0.5));
    }
    
    public static function ceil($_value): Ceiling
    {
        return new Ceiling($_value);
    }
    
    public static function fact($_value): Factorial
    {
        return new Factorial($_value);
    }
    
    public static function sin($_value): Sine
    {
        return new Sine($_value);
    }
    
    public static function cos($_value): Cosine
    {
        return new Cosine($_value);
    }
    
    public static function tan($_value): Tangent
    {
        return new Tangent($_value);
    }
    
    // VALUES
    public static function value(float $_value): Value
    {
        return new Value($_value);
    }
    public static function var(string $_id): Variable
    {
        return new Variable($_id);
    }
    public static function alias(string $_alias, float $_value): AliasValue
    {
        return new AliasValue($_alias, $_value);
    }
    
    public static function pi(): AliasValue
    {
        return new AliasValue('π', M_PI);
    }
    
    public static function e(): AliasValue
    {
        return new AliasValue('e', M_E);
    }
    
    public static function infinity(): AliasValue
    {
        return new AliasValue('∞', INF);
    }
}