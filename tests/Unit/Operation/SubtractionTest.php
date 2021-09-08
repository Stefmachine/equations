<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Operation\Subtraction;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class SubtractionTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Subtraction($_generator->make(1), $_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Subtraction(EquationValueMock::mock(1), EquationValueMock::mock(3));
        
        $this->assertSame('1 - 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Subtraction(EquationValueMock::mock(1), EquationValueMock::mock(3));
    
        $this->assertSame(-2.0, $instance->eval());
    }
}