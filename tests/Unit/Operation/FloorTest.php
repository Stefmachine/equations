<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Floor;

class FloorTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Floor('$123');
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Floor(1);
        
        $this->assertSame('⌊1⌋', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Floor('x');
        
        $this->assertSame('⌊x⌋', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Floor('x');
        
        $this->assertSame('⌊1⌋', $instance->toString(['x' => 1]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnLowerIntegerResult_WhenUsingEval()
    {
        $instance = new Floor(1.5);
    
        $this->assertSame(1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnLowerIntegerResult_WhenUsingEvalWithNegativeValue()
    {
        $instance = new Floor(-1.5);
    
        $this->assertSame(-2.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Floor('x');
    
        $this->assertSame(1.0, $instance->eval(['x' => 1.5]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Floor('x');
        $instance->eval();
    }
}