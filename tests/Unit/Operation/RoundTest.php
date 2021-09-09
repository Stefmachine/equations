<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Operation\Round;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class RoundTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Round($_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Round(EquationValueMock::mock(1));
        
        $this->assertSame('⌊1⌉', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnHigherIntegerResult_WhenUsingEvalWithHalfInteger()
    {
        $instance = new Round(EquationValueMock::mock(1.5));
    
        $this->assertSame(2.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnLowerIntegerResult_WhenUsingEvalWithLessThanHalfInteger()
    {
        $instance = new Round(EquationValueMock::mock(1.4999));
    
        $this->assertSame(1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnHigherIntegerResult_WhenUsingEvalWithNegativeHalfInteger()
    {
        $instance = new Round(EquationValueMock::mock(-1.5));
    
        $this->assertSame(-2.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnLowerIntegerResult_WhenUsingEvalWithNegativeLessThanHalfInteger()
    {
        $instance = new Round(EquationValueMock::mock(-1.4999));
        
        $this->assertSame(-1.0, $instance->eval());
    }
}