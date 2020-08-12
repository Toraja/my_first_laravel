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

    /**
     * @OA\Get(
     *     path="/api/animal-types",
     *     description="list animal types",
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="type_id", type="integer"),
     *                 @OA\Property(property="type_name", type="string"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function listTypes()
    {
        $types = [];
        foreach ($this->animalTypes as $id => $name) {
            array_push($types, ['type_id' => $id, 'type_name' => $name]);
        }
        return response(json_encode($types));
    }

    /**
     * @OA\Get(
     *     path="/api/animal-types/{id}",
     *     description="list animal types",
     *     @OA\Parameter(
     *         name="id",
     *         description="animal type ID",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="type_name", type="string"),
     *         ),
     *     ),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function animalOfID($typeID)
    {
        if (array_key_exists($typeID, $this->animalTypes)) {
            return response(['type_name' => $this->animalTypes[$typeID]]);
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

    /**
     * @OA\Get(
     *     path="/api/animals",
     *     description="get animals",
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="type", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="age", type="integer"),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function getAnimals()
    {
        return response($this->animals);
    }

    /**
    * @OA\Post(
    *     path="/api/animals",
    *     description="Add an animal",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="type", type="integer"),
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="age", type="integer"),
    *         ),
    *     ),
    *     @OA\Response(
    *         response="302",
    *         description="redirect to /api/animals",
    *     ),
    * )
    */
    public function addAnimal()
    {
        array_push($this->animals, request());
        return redirect('/api/animals');
    }
}
