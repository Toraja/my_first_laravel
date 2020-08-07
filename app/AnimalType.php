<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class AnimalType extends Model
{
    const ELEPHANT = 1;
    const GIRAFFE = 2;
    const MONKEY = 3;
    const WOLF = 4;

    private function __construct()
    {
    }
}
