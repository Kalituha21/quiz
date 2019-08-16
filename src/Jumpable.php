<?php


namespace Quiz;


trait Jumpable
{
    public function jump()
    {
        echo get_class() . ' is jumping</br>';
    }
}