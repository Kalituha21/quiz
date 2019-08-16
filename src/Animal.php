<?php

namespace Quiz;

abstract class Animal
{
    const TYPE = 'Unknown';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $energy = 10;

    static public $animalCount = 0;

    /**
     * Animal constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        self::$animalCount++;
        echo 'Animal of type ' . static::TYPE . ' was created.<br>';
    }

    public function run()
    {
        $this->energy--;
    }

    public function sleep()
    {
        $this->energy++;
    }

    abstract function preferedFood(): string;

    abstract function eat(string $food): void;
}