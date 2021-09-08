<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Operation\Tangent;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class TangentTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Tangent($_generator->make(3 * M_PI / 4));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Tangent(EquationValueMock::mock(1));
        
        $this->assertSame('tan(1)', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Tangent(EquationValueMock::mock(3 * M_PI / 4));
    
        $this->assertSame(-1.0, $instance->eval());
    }
}