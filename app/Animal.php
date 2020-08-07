<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTime;

class Animal extends Model
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var DateTime
     */
    private $birthday;
    /**
     * @var AnimalType
     */
    private $type;

    /**
     * @param string $name
     * @param DateTime $birthday
     * @param AnimalType $type
     */
    public function __construct(string $name, DateTime $birthday, AnimalType $type)
    {
        $this->name = $name;
        $this->birthday = $birthday;
        $this->type = $type;
    }

    /**
     * get age of the animal
     *
     * @return int
     */
    public function age() : int
    {
        return now()->diff($this->birthday)->y;
    }
}
