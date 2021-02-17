<?php
class StringHandler 
{
    public function length() 
    {
        return strlen($this);
    }

    public function trim()
    {
        return trim($this);
    }

    public function formatString()
    {
        return ucfirst(strtolower($this));
    }
}
    register_primitive_type_handler('string', 'StringHandler');



