<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Absolute;

class AbsoluteTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Absolute('$123');
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Absolute(1);
        
        $this->assertSame('|1|', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Absolute('x');
        
        $this->assertSame('|x|', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Absolute('x');
        
        $this->assertSame('|1|', $instance->toString(['x' => 1]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Absolute(1);
    
        $this->assertSame(1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnPositiveResult_WhenUsingEvalWithNegativeValue()
    {
        $instance = new Absolute(-1);
    
        $this->assertSame(1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Absolute('x');
    
        $this->assertSame(1.0, $instance->eval(['x' => 1]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Absolute('x');
        $instance->eval();
    }
}