<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Operation\Modulo;

class ModuloTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithInvalidValueOrVariable()
    {
        $this->expectException(EquationException::class);
        
        new Modulo('$123', 1);
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Modulo(1, 3);
        
        $this->assertSame('1 mod 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithVariable_WhenUsingToStringWithoutVariable()
    {
        $instance = new Modulo('x', 3);
        
        $this->assertSame('x mod 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringWithResolvedVariable_WhenUsingToStringWithVariableResolved()
    {
        $instance = new Modulo('x', 3);
        
        $this->assertSame('1 mod 3', $instance->toString(['x' => 1]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Modulo(5, 3);
    
        $this->assertSame(2.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEvalWithResolvedVariable()
    {
        $instance = new Modulo('x', 3);
    
        $this->assertSame(2.0, $instance->eval(['x' => 5]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Modulo('x', 3.0);
        $instance->eval();
    }
}