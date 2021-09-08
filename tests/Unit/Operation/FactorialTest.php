<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Operation\Factorial;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class FactorialTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Factorial($_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Factorial(EquationValueMock::mock(1));
        
        $this->assertSame('1!', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Factorial(EquationValueMock::mock(5));
    
        $this->assertSame(120.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnOne_WhenUsingEvalWithZero()
    {
        $instance = new Factorial(EquationValueMock::mock(0));
    
        $this->assertSame(1.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithNegativeValue()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Factorial(EquationValueMock::mock(-1));
        $instance->eval();
    }
}