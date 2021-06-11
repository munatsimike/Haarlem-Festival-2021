<?php

abstract class NumberGenerator
{
    protected function generateNum()
    {
        return (int)time();
    }
}