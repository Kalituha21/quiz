<?php


namespace Quiz;


class Owner
{
    /**
     * @var Animal[]
     */
    private $pets = [];
    /**
     * @var string
     */
    private $name;
    use Jumpable;
    public function __construct(string $name, array $pets)
    {
        $this->name = $name;
        $this->pets = $pets;
    }

    public function feed()
    {
        foreach ($this->pets as $pet) {
            $this->feedAnimal($pet);
        }
    }

    public function feedAnimal(Animal $pet)
    {
        $food = $pet->preferedFood();
        $pet->eat($food);
    }

    public function flyWithAnimals()
    {
        foreach ($this->pets as $pet) {
            if (is_a($pet, Flyable::class)) {
                $pet->fly(2);
            }
        }
    }
}