<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;
use Stefmachine\Equations\Operation\Modulo;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class ModuloTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Modulo($_generator->make(1), $_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Modulo(EquationValueMock::mock(1), EquationValueMock::mock(3));
        
        $this->assertSame('1 mod 3', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnResult_WhenUsingEval()
    {
        $instance = new Modulo(EquationValueMock::mock(5), EquationValueMock::mock(3));
    
        $this->assertSame(2.0, $instance->eval());
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenDivisorIsZero()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $instance = new Modulo(EquationValueMock::mock(1), EquationValueMock::mock(0));
        $instance->eval();
    }
}