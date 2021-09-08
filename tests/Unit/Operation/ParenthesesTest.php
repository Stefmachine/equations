<?php


namespace Stefmachine\EquationsTests\Unit\Operation;


use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Operation\Parentheses;
use Stefmachine\EquationsTests\Base\EquationTest;
use Stefmachine\EquationsTests\Mock\EquationValueMock;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

class ParenthesesTest extends EquationTest
{
    protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface
    {
        return new Parentheses($_generator->make(1));
    }
    
    
    /**
     * @test
     */
    public function Should_ReturnString_WhenUsingToString()
    {
        $instance = new Parentheses(EquationValueMock::mock(1));
        
        $this->assertSame('(1)', $instance->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnValue_WhenUsingEval()
    {
        $instance = new Parentheses(EquationValueMock::mock(1));
    
        $this->assertSame(1.0, $instance->eval());
    }
}