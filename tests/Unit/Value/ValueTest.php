<?php

namespace Stefmachine\EquationsTests\Unit\Value;

use Stefmachine\Equations\Value\Value;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    /**
     * @test
     */
    public function Should_ReturnStringOfValue_WhenUsingToString()
    {
        $value = new Value(1.599);
        $this->assertSame('1.599', $value->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnValue_WhenUsingEval()
    {
        $value = new Value(1.599);
        $this->assertSame(1.599, $value->eval());
    }
}
