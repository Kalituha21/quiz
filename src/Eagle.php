<?php


namespace Quiz;


class Eagle extends Animal implements Flyable
{
    const TYPE = 'Eagle';

    function preferedFood(): string
    {
        return 'smal dog';
    }

    function eat(string $food): void
    {
        echo 'Eagle is eating ' . $food . '<br>';
    }

    public function fly(int $distance): void
    {
        $this->energy -= $distance;
        echo "Eagle is flying";
    }
}