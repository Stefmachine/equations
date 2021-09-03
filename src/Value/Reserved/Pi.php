<?php


namespace Stefmachine\Equations\Value\Reserved;


use Stefmachine\Equations\Value\Value;

class Pi extends Value
{
    public function __construct()
    {
        parent::__construct(M_PI);
    }
    
    public function toString(array $_values = array()): string
    {
        return 'π';
    }
}