<?php

class Validator
{
    public static function isValidUnixTimestamp(string $timestamp) : bool
    {
       return ( is_numeric($timestamp) && (int)$timestamp == $timestamp );
    }
}