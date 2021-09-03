<?php

abstract class AGenerator
{
    protected function generateUnixTimeStamp() : string
    {
        return time();
    }
}