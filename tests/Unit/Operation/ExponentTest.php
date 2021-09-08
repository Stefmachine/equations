<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Exponentiation;

class ExponentTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Exponentiation('$123', 3);
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Exponentiation(2, 3);
        
        $this->assertSame('2 ^ 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Exponentiation('x', 3);
        
        $this->assertSame('x ^ 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Exponentiation('x', 3);
        
        $this->assertSame('2 ^ 3', $instance->toString(['x' => 2]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Exponentiation(2, 3);
    
        $this->assertSame(8.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnPositiveResult_WhenUsingEvalWithNegativePowerAndEvenExponent()
    {
        $instance = new Exponentiation(-2, 4);
    
        $this->assertSame(16.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnNegativeResult_WhenUsingEvalWithNegativePowerAndUnevenExponent()
    {
        $instance = new Exponentiation(-2, 3);
    
        $this->assertSame(-8.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Exponentiation('x', 3.0);
    
        $this->assertSame(8.0, $instance->eval(['x' => 2]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Exponentiation('x', 3);
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithRootOfNegative()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Exponentiation(-1, 0.5);
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithBaseZeroAndExponentZero()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Exponentiation(0, 0);
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithBaseZeroAndNegativeExponent()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Exponentiation(0, -1);
        $instance->eval();
    }
}