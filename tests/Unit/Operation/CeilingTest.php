<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Operation\Ceiling;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class CeilingTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Ceiling($_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Ceiling(EquationValueMock::mock(1));
        
        $this->assertSame('⌈1⌉', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnHigherIntegerResult_WhenUsingEval()
    {
        $instance = new Ceiling(EquationValueMock::mock(1.5));
    
        $this->assertSame(2.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnHigherIntegerResult_WhenUsingEvalWithNegativeValue()
    {
        $instance = new Ceiling(EquationValueMock::mock(-1.5));
    
        $this->assertSame(-1.0, $instance->eval());
    }
}