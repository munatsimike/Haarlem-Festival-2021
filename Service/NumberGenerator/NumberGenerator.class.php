<?php

abstract class NumberGenerator
{
    protected function generateNum()
    {
        //return rand(100000, 999999);
         
        return (int)time();
    }
}