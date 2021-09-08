<?php

namespace Stefmachine\EquationsTests\Unit;

use Stefmachine\Equations\Eq;
use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Operation\Absolute;
use Stefmachine\Equations\Operation\Addition;
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
use Stefmachine\Equations\Operation\Tangent;
use Stefmachine\Equations\Value\AliasValue;
use Stefmachine\Equations\Value\Value;
use Stefmachine\Equations\Value\Variable;

class EqTest extends TestCase
{
    // Operations
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfDivision_WhenUsingDivide()
    {
        $this->assertInstanceOf(Division::class, Eq::divide(1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfMultiplication_WhenUsingMultiply()
    {
        $this->assertInstanceOf(Multiplication::class, Eq::multiply(1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAddition_WhenUsingMultiplyWithMoreFactors()
    {
        $this->assertInstanceOf(Multiplication::class, Eq::multiply(1, 1, 1, 1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfSubtraction_WhenUsingMinus()
    {
        $this->assertInstanceOf(Subtraction::class, Eq::minus(1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAddition_WhenUsingPlus()
    {
        $this->assertInstanceOf(Addition::class, Eq::plus(1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAddition_WhenUsingPlusWithMoreAddends()
    {
        $this->assertInstanceOf(Addition::class, Eq::plus(1, 1, 1, 1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfModulo_WhenUsingMod()
    {
        $this->assertInstanceOf(Modulo::class, Eq::mod(1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfExponentiation_WhenUsingPower()
    {
        $this->assertInstanceOf(Exponentiation::class, Eq::power(1, 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfExponentiation_WhenUsingRoot()
    {
        $this->assertInstanceOf(Exponentiation::class, Eq::root(4, 2));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfLogarithm_WhenUsingLog()
    {
        $this->assertInstanceOf(Logarithm::class, Eq::log(4, 2));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfLogarithm_WhenUsingLn()
    {
        $this->assertInstanceOf(Logarithm::class, Eq::ln(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAbsolute_WhenUsingAbs()
    {
        $this->assertInstanceOf(Absolute::class, Eq::abs(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfFloor_WhenUsingFloor()
    {
        $this->assertInstanceOf(Floor::class, Eq::floor(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfFloor_WhenUsingRound()
    {
        $this->assertInstanceOf(Floor::class, Eq::round(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfCeiling_WhenUsingCeil()
    {
        $this->assertInstanceOf(Ceiling::class, Eq::ceil(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfFactorial_WhenUsingFact()
    {
        $this->assertInstanceOf(Factorial::class, Eq::fact(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfSine_WhenUsingSin()
    {
        $this->assertInstanceOf(Sine::class, Eq::sin(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfCosine_WhenUsingCos()
    {
        $this->assertInstanceOf(Cosine::class, Eq::cos(4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfTangent_WhenUsingTan()
    {
        $this->assertInstanceOf(Tangent::class, Eq::tan(4));
    }
    
    
    // Values
    /**
     * @test
     */
    public function Should_ReturnInstanceOfValue_WhenUsingValue()
    {
        $this->assertInstanceOf(Value::class, Eq::value(1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfVariable_WhenUsingVar()
    {
        $this->assertInstanceOf(Variable::class, Eq::var('test'));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAliasValue_WhenUsingAlias()
    {
        $this->assertInstanceOf(AliasValue::class, Eq::alias('test', 1));
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAliasValue_WhenUsingPi()
    {
        $this->assertInstanceOf(AliasValue::class, Eq::pi());
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAliasValue_WhenUsingE()
    {
        $this->assertInstanceOf(AliasValue::class, Eq::e());
    }
    
    /**
     * @test
     */
    public function Should_ReturnInstanceOfAliasValue_WhenUsingInfinity()
    {
        $this->assertInstanceOf(AliasValue::class, Eq::infinity());
    }
}
