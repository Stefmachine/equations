<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Multiplication;

class MultiplicationTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Multiplication('$123', 1);
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Multiplication(1, 3);
        
        $this->assertSame('1 * 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Multiplication('x', 3);
        
        $this->assertSame('x * 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Multiplication('x', 3);
        
        $this->assertSame('1 * 3', $instance->toString(['x' => 1]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Multiplication(1, 3);
    
        $this->assertSame(3.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Multiplication('x', 3.0);
    
        $this->assertSame(3.0, $instance->eval(['x' => 1]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Multiplication('x', 3.0);
        $instance->eval();
    }
}