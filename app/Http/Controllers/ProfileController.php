<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function profile(){
        $user = auth()->user();
        // $user = auth()->user()->id;
        return response(
        [
        "success" => true,
        "message" => "User profile get succsessfully",
        "data" => $user
        ],
        Response::HTTP_OK
        );
    }
}
