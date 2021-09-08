<?php

namespace Stefmachine\EquationsTests\Integration;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Eq;
use Stefmachine\Equations\EquationInterface;
use Stefmachine\Equations\Exception\EquationEvaluationException;

class ComplexEquationTest extends TestCase
{
    private function getComplexEquation(): EquationInterface
    {
        return Eq::plus('x', Eq::divide(Eq::multiply(Eq::minus('x', 5), 'y'), 4));
    }
    
    /**
     * @test
     */
    public function Should_ReturnStringOfEquation_WhenUsingToStringOnEquation()
    {
        $string = $this->getComplexEquation()->toString(['x' => 10]);
        
        $this->assertSame('10 + (((10 - 5) * y) / 4)', $string);
    }
    
    /**
     * @test
     */
    public function Should_ReturnEquationResult_WhenUsingEvalOnEquation()
    {
        $result = $this->getComplexEquation()->eval(['y' => 2, 'x' => 10]);
    
        $this->assertSame(12.5, $result);
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalAndMissingVariable()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $this->getComplexEquation()->eval(['x' => 10]);
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalAndVariablesHaveCircularReference()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $this->getComplexEquation()->eval(['x' => 'y', 'y' => 'x']);
    }
}
