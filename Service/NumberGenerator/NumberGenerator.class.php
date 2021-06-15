<?php

abstract class NumberGenerator
{
    protected function generateUnixTimeStamp() : string
    {
        return time();
    }

    public function isValidUnixTimestamp(string $timestamp) : bool
    {
       return ( is_numeric($timestamp) && (int)$timestamp == $timestamp );
    }
}