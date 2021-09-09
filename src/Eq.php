<?php


namespace Stefmachine\Equations;


use Stefmachine\Equations\Helper\EqHelper;
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
use Stefmachine\Equations\Operation\Round;
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
    public static function plus($_addendA, $_addendB, ...$_otherAddends): Addition
    {
        return new Addition(EqHelper::parseValue($_addendA), EqHelper::parseValue($_addendB), ...EqHelper::parseValues($_otherAddends));
    }
    
    public static function minus($_minuend, $_subtrahend): Subtraction
    {
        return new Subtraction(EqHelper::parseValue($_minuend), EqHelper::parseValue($_subtrahend));
    }
    
    public static function multiply($_factorA, $_factorB, ...$_otherFactors): Multiplication
    {
        return new Multiplication(EqHelper::parseValue($_factorA), EqHelper::parseValue($_factorB), ...EqHelper::parseValues($_otherFactors));
    }
    
    public static function divide($_dividend, $_divisor): Division
    {
        return new Division(EqHelper::parseValue($_dividend), EqHelper::parseValue($_divisor));
    }
    
    public static function mod($_dividend, $_divisor): Modulo
    {
        return new Modulo(EqHelper::parseValue($_dividend), EqHelper::parseValue($_divisor));
    }
    
    public static function power($_base, $_exponent): Exponentiation
    {
        return new Exponentiation(EqHelper::parseValue($_base), EqHelper::parseValue($_exponent));
    }
    
    public static function root($_rootIndex, $_radicand): Exponentiation
    {
        return new Exponentiation(EqHelper::parseValue($_radicand), Eq::divide(1, $_rootIndex));
    }
    
    public static function log($_base, $_argument): Logarithm
    {
        return new Logarithm(EqHelper::parseValue($_base), EqHelper::parseValue($_argument));
    }
    
    public static function ln($_argument): Logarithm
    {
        return new Logarithm(Eq::e(), EqHelper::parseValue($_argument));
    }
    
    public static function abs($_value): Absolute
    {
        return new Absolute(EqHelper::parseValue($_value));
    }
    
    public static function floor($_value): Floor
    {
        return new Floor(EqHelper::parseValue($_value));
    }
    
    public static function round($_value): Round
    {
        return new Round(EqHelper::parseValue($_value));
    }
    
    public static function ceil($_value): Ceiling
    {
        return new Ceiling(EqHelper::parseValue($_value));
    }
    
    public static function fact($_value): Factorial
    {
        return new Factorial(EqHelper::parseValue($_value));
    }
    
    public static function sin($_value): Sine
    {
        return new Sine(EqHelper::parseValue($_value));
    }
    
    public static function cos($_value): Cosine
    {
        return new Cosine(EqHelper::parseValue($_value));
    }
    
    public static function tan($_value): Tangent
    {
        return new Tangent(EqHelper::parseValue($_value));
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