<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Operation\Exponentiation;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class ExponentiationTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Exponentiation($_generator->make(1), $_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Exponentiation(EquationValueMock::mock(2), EquationValueMock::mock(3));
        
        $this->assertSame('2 ^ 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Exponentiation(EquationValueMock::mock(2), EquationValueMock::mock(3));
    
        $this->assertSame(8.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnPositiveResult_WhenUsingEvalWithNegativePowerAndEvenExponent()
    {
        $instance = new Exponentiation(EquationValueMock::mock(-2), EquationValueMock::mock(4));
    
        $this->assertSame(16.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ReturnNegativeResult_WhenUsingEvalWithNegativePowerAndUnevenExponent()
    {
        $instance = new Exponentiation(EquationValueMock::mock(-2), EquationValueMock::mock(3));
    
        $this->assertSame(-8.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithRootOfNegative()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Exponentiation(EquationValueMock::mock(-1), EquationValueMock::mock(0.5));
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithBaseZeroAndExponentZero()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Exponentiation(EquationValueMock::mock(0), EquationValueMock::mock(0));
        $instance->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithBaseZeroAndNegativeExponent()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Exponentiation(EquationValueMock::mock(0), EquationValueMock::mock(-1));
        $instance->eval();
    }
}