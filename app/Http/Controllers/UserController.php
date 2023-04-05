<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        return "GetAllUsers";
    }

    public function createUser(){
        return "CreateUser";
    }

    public function updateUser(){
        return "UpdateUser";
    }

    public function deleteUser(){
        return "DeleteUser";
    }
}
