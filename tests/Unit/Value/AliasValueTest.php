<?php

namespace Stefmachine\EquationsTests\Unit\Value;

use Stefmachine\Equations\Value\AliasValue;
use PHPUnit\Framework\TestCase;

class AliasValueTest extends TestCase
{
    /**
     * @test
     */
    public function Should_ReturnStringOfAlias_WhenUsingToString()
    {
        $value = new AliasValue('test',1.599);
        $this->assertSame('test', $value->toString());
    }
    
    /**
     * @test
     */
    public function Should_ReturnValue_WhenUsingEval()
    {
        $value = new AliasValue('test',1.599);
        $this->assertSame(1.599, $value->eval());
    }
}
