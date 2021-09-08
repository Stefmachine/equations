<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Cosine;

class CosineTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Cosine('$123');
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Cosine(1);
        
        $this->assertSame('cos(1)', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Cosine('x');
        
        $this->assertSame('cos(x)', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Cosine('x');
        
        $this->assertSame('cos(1)', $instance->toString(['x' => 1]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Cosine(M_PI);
    
        $this->assertSame(-1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Cosine('x');
    
        $this->assertSame(-1.0, $instance->eval(['x' => M_PI]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Cosine('x');
        $instance->eval();
    }
}