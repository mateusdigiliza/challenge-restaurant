<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;

use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        return[];
    }

    public function store(UserStoreRequest $request)
    {

        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if($user !== null){
            throw new \Exception("User already exists!");
        }

        $user = User::create($validated);
    }
}
