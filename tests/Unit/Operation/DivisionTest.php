<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Operation\Division;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class DivisionTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Division($_generator->make(1), $_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Division(EquationValueMock::mock(1), EquationValueMock::mock(3));
        
        $this->assertSame('1 / 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Division(EquationValueMock::mock(1), EquationValueMock::mock(2));
    
        $this->assertSame(0.5, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenDivisorIsZero()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Division(EquationValueMock::mock(1), EquationValueMock::mock(0));
        $instance->eval();
    }
}