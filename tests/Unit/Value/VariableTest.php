<?php

namespace Stefmachine\EquationsTests\Unit\Value;

use Stefmachine\Equations\Exception\EquationEvaluationException;
use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\Exception\EquationException;
use Stefmachine\Equations\Value\Variable;

class VariableTest extends TestCase
{
    // CONSTRUCTOR
    /**
     * @test
     */
    public function Should_ThrowException_WhenConstructingWithNumberVariableName()
    {
        $this->expectException(EquationException::class);
        
        new Variable('1test');
    }
    
    /**
     * @test
     */
    public function Should_Instantiate_WhenConstructingWithValidVariableNames()
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $secondChars = $chars.'0123456789_';
        
        foreach (str_split($chars) as $char){
            $this->assertInstanceOf(Variable::class, new Variable($char), "Expected variable name '{$char}' to be valid.");
        }
        
        foreach (str_split($secondChars) as $char){
            $this->assertInstanceOf(Variable::class, new Variable('a'.$char), "Expected variable name 'a{$char}' to be valid.");
        }
    }
    
    // TO STRING
    /**
     * @test
     */
    public function Should_ReturnId_WhenUsingToString()
    {
        $var = new Variable('test');
        $this->assertSame('test', $var->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnVariableId_WhenUsingToStringWithoutVariableChainResolving()
    {
        $var = new Variable('test');
        $this->assertSame('w', $var->toString([
            'test' => 'x',
            'x' => 'w'
        ]));
    }
    
    /**
     * @test
     */
    public function Should_ReturnValueString_WhenUsingToStringWithValueInArray()
    {
        $var = new Variable('test');
        $this->assertSame('1.599', $var->toString([
            'test' => 1.599
        ]));
    }
    
    // EVAL
    /**
     * @test
     */
    public function Should_ReturnValue_WhenUsingEvalWithValueInArray()
    {
        $var = new Variable('test');
        $this->assertSame(1.599, $var->eval([
            'test' => 1.599
        ]));
    }
    
    /**
     * @test
     */
    public function Should_ReturnValue_WhenUsingEvalWithNumericStringValueInArray()
    {
        $var = new Variable('test');
        $this->assertSame(1.599, $var->eval([
            'test' => '1.599'
        ]));
    }
    
    /**
     * @test
     */
    public function Should_ReturnVariableValue_WhenUsingEvalWithVariableChain()
    {
        $var = new Variable('test');
        $this->assertSame(1.599, $var->eval([
            'test' => 'x',
            'x' => 1.599
        ]));
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutValueInArray()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $var = new Variable('test');
        $result = $var->eval();
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithoutVariableChainResolving()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $var = new Variable('test');
        $result = $var->eval([
            'test' => 'x',
            'x' => 'w'
        ]);
    }
    
    /**
     * @test
     */
    public function Should_ThrowException_WhenUsingEvalWithCircularVariableChain()
    {
        $this->expectException(EquationEvaluationException::class);
        
        $var = new Variable('test');
        $result = $var->eval([
            'test' => 'x',
            'x' => 'w'
        ]);
    }
}
