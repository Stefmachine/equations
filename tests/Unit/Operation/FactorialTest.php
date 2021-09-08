<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Factorial;

class FactorialTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Factorial('$123');
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Factorial(1);
        
        $this->assertSame('1!', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Factorial('x');
        
        $this->assertSame('x!', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Factorial('x');
        
        $this->assertSame('1!', $instance->toString(['x' => 1]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Factorial(5);
    
        $this->assertSame(120.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Factorial('x');
    
        $this->assertSame(120.0, $instance->eval(['x' => 5]));
    }
    
    /**
     * @test
     */
    public function Should_ReturnOne_WhenUsingEvalWithZero()
    {
        $instance = new Factorial(0);
    
        $this->assertSame(1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Factorial('x');
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithNegativeValue()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Factorial(-1);
        $instance->eval();
    }
}