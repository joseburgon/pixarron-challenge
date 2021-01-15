<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('addresses')->paginate();

        return UserCollection::make($users);
    }


    public function show(User $user)
    {
        return UserResource::make(
            $user->load(['addresses', 'orders'])
        );
    }
}
