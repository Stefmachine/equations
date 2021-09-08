<?php


namespace Stefmachine\EquationsTests\Base;


use PHPUnit\Framework\TestCase;
use Stefmachine\Equations\EquationInterface;
use Stefmachine\EquationsTests\Mock\ForwardTesterMockGenerator;

abstract class EquationTest extends TestCase
{
    abstract protected function getValidInstance(ForwardTesterMockGenerator $_generator): EquationInterface;
    
    /**
     * @test
     */
    public function Should_ForwardValues_WhenUsingToStringAndPassingArrayOfValues()
    {
        $gen = new ForwardTesterMockGenerator();
        
        $instance = $this->getValidInstance($gen);
        $values = array(
            'a' => 1,
            'b' => 2
        );
        $instance->toString($values);
        
        foreach ($gen as $index => $tester){
            $this->assertEquals($values, $tester->values, "Failed to assert that values are forwarded to argument {$index} in toString.");
        }
    }
    
    /**
     * @test
     */
    public function Should_ForwardOptions_WhenUsingToStringAndPassingArrayOfOptions()
    {
        $gen = new ForwardTesterMockGenerator();
    
        $instance = $this->getValidInstance($gen);
        $options = array(
            'a' => 1,
            'b' => 2
        );
        $instance->toString([], $options);
    
        foreach ($gen as $index => $tester){
            $this->assertEquals($options, $tester->options, "Failed to assert that options are forwarded to argument {$index} in toString.");
        }
    }
    
    /**
     * @test
     */
    public function Should_ForwardValues_WhenUsingEvalAndPassingArrayOfValues()
    {
        $gen = new ForwardTesterMockGenerator();
        
        $instance = $this->getValidInstance($gen);
        $values = array(
            'a' => 1,
            'b' => 2
        );
        $instance->eval($values);
        
        foreach ($gen as $index => $tester){
            $this->assertEquals($values, $tester->values, "Failed to assert that values are forwarded to argument {$index} in eval.");
        }
    }
    
    /**
     * @test
     */
    public function Should_ForwardOptions_WhenUsingEvalAndPassingArrayOfOptions()
    {
        $gen = new ForwardTesterMockGenerator();
    
        $instance = $this->getValidInstance($gen);
        $options = array(
            'a' => 1,
            'b' => 2
        );
        $instance->eval([], $options);
    
        foreach ($gen as $index => $tester){
            $this->assertEquals($options, $tester->options, "Failed to assert that options are forwarded to argument {$index} in eval.");
        }
    }
}