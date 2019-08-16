<?php


namespace Quiz;


class Dog extends Animal
{
    const TYPE = 'Dog';

    public function run()
    {
        $this->energy -= 2;
    }

    function eat(string $food): void
    {
        echo 'Dog is eating ' . $food . '<br>';
    }

    function preferedFood(): string
    {
        return 'bone';
    }
}