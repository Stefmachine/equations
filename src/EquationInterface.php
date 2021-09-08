<?php


namespace Stefmachine\Equations;


interface EquationInterface
{
    /**
     * @param array<string, string|float> $_values
     * @param array<string, mixed> $_options
     * @return string
     */
    public function toString(array $_values = array(), array $_options = array()): string;
    
    /**
     * @param array<string, string|float> $_values
     * @param array<string, mixed> $_options
     * @return float
     */
    public function eval(array $_values = array(), array $_options = array()): float;
}