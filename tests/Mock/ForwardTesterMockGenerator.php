<?php


namespace Stefmachine\EquationsTests\Mock;


use ArrayIterator;
use IteratorAggregate;
use Stefmachine\Equations\EquationInterface;

class ForwardTesterMockGenerator implements IteratorAggregate
{
    /** @var EquationMockForwardTester[] */
    protected $mocks;
    
    public function __construct()
    {
        $this->mocks = [];
    }
    
    public function make(float $_value): EquationInterface
    {
        $mock = EquationMockForwardTester::mock($_value);
        $this->mocks[] = $mock;
        return $mock;
    }
    
    /**
     * @return EquationMockForwardTester[]|ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->mocks);
    }
}