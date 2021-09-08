<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Operation\Logarithm;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class LogarithmTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Logarithm($_generator->make(10), $_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Logarithm(EquationValueMock::mock(1), EquationValueMock::mock(3));
        
        $this->assertSame('log(1) 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Logarithm(EquationValueMock::mock(10), EquationValueMock::mock(1));
    
        $this->assertSame(0.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithBaseZero()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Logarithm(EquationValueMock::mock(0), EquationValueMock::mock(10));
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithNegativeBase()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Logarithm(EquationValueMock::mock(-5), EquationValueMock::mock(10));
        $instance->eval();
    }
}