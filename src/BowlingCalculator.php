<?php


namespace Quiz;


class BowlingCalculator
{

    /**
     * @var array
     */
    private $throws = [];

    private $currentThrow = 0;

    public function throw(int $points)
    {
        $this->throws[] = $points;
    }

    public function getResults(): int
    {
        $result = 0;
        for ($i = 0; $i < 10; $i++) {
            if ($this->isStrike()) {
                $result += $this->getStrikePoints();
                $this->currentThrow += 1;
            } elseif ($this->isSpare()) {
                $result += $this->getSparePoints();
                $this->currentThrow += 2;
            } else {
                $result += $this->getNormalPoints();
                $this->currentThrow += 2;
            }
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function isSpare(): bool
    {
        return $this->throws[$this->currentThrow] + $this->throws[$this->currentThrow + 1] == 10;
    }

    /**
     * @return int
     */
    public function getNormalPoints(): int
    {
        return $this->throws[$this->currentThrow] + $this->throws[$this->currentThrow + 1];
    }

    /**
     * @return int
     */
    public function getSparePoints(): int
    {
        return $this->getNormalPoints() + $this->throws[$this->currentThrow + 2];
    }

    /**
     * @return bool
     */
    public function isStrike(): bool
    {
        return $this->throws[$this->currentThrow] == 10;
    }

    /**
     * @return int
     */
    public function getStrikePoints(): int
    {
        return 10 + $this->throws[$this->currentThrow + 1] + $this->throws[$this->currentThrow + 2];
    }
}