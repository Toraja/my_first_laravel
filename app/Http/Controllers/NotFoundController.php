<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotFoundController extends Controller
{
    public function notFound()
    {
        return response("Not Found", 404);
    }
}
