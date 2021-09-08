<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Logarithm;

class LogarithmTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Logarithm('$123', 1);
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Logarithm(1, 3);
        
        $this->assertSame('log(1) 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Logarithm('x', 3);
        
        $this->assertSame('log(x) 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Logarithm('x', 3);
        
        $this->assertSame('log(1) 3', $instance->toString(['x' => 1]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Logarithm(10, 1);
    
        $this->assertSame(0.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Logarithm('x', 1);
    
        $this->assertSame(0.0, $instance->eval(['x' => 10]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Logarithm('x', 1);
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithBaseZero()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Logarithm(0, 10);
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithBaseZeroAndNegativeExponent()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Logarithm(-5, 10);
        $instance->eval();
    }
}