<?php


namespace Stefmachine\Equations;


interface EquationInterface
{
    public function toString(array $_values = array()): string;
    
    /**
     * @param array<int, string|float> $_values
     * @return float
     */
    public function eval(array $_values = array()): float;
}