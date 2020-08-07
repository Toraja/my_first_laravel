<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    private $animalTypes = [
        1 => 'Dog',
        2 => 'Cat',
        3 => 'Bird',
    ];

    private $animals = [
        ['type' => 1, 'name' => 'John', 'age' => 3],
        ['type' => 1, 'name' => 'Tom', 'age' => 4],
        ['type' => 1, 'name' => 'Bob', 'age' => 5],
        ['type' => 2, 'name' => 'Kathy', 'age' => 4],
        ['type' => 2, 'name' => 'Carine', 'age' => 5],
    ];

    public function listTypes()
    {
        return response($this->animalTypes);
    }

    public function animalOfID($typeID)
    {
        if (array_key_exists($typeID, $this->animalTypes)) {
            return response($this->animalTypes[$typeID]);
        }
        return (new NotFoundController())->notFound();
    }

    public function animalsOfType($typeID)
    {
        $animals = array_filter($this->animals, function ($animal) use ($typeID) {
            return $animal['type'] == $typeID;
        });
        return response($animals);
    }

    public function animalWithAge($typeID, $age)
    {
        $animals = array_filter($this->animals, function ($animal) use ($typeID, $age) {
            return $animal['type'] == $typeID && $animal['age'] == $age;
        });
        return response($animals);
    }

    public function addAnimal()
    {
        // TODO implement
        echo 'hi';
    }
}
