<?php


namespace Quiz;


class Cat extends Animal
{
    const TYPE = 'Cat';

    public function run()
    {
        $this->energy -= 3;
    }

    function eat(string $food): void
    {
        echo 'Cat is eating ' . $food . '<br>';
    }

    function preferedFood(): string
    {
        return 'fish';
    }
}