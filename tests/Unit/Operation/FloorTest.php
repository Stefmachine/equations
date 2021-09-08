<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Operation\Floor;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class FloorTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Floor($_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Floor(EquationValueMock::mock(1));
        
        $this->assertSame('⌊1⌋', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnLowerIntegerResult_WhenUsingEval()
    {
        $instance = new Floor(EquationValueMock::mock(1.5));
    
        $this->assertSame(1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnLowerIntegerResult_WhenUsingEvalWithNegativeValue()
    {
        $instance = new Floor(EquationValueMock::mock(-1.5));
    
        $this->assertSame(-2.0, $instance->eval());
    }
}