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
        if (auth()->user()->hasRole('admin')) {

            $users = User::with('addresses')->paginate();

            return UserCollection::make($users);

        } else {

            return response([
                'message' => 'You don\'t have permission to access this information.'
            ]);

        }
    }


    public function show(User $user)
    {
        $authUser = auth()->user();

        if ($user->id === $authUser->id || $authUser->hasRole('admin')) {

            return UserResource::make(
                $user->load(['addresses', 'orders'])
            );

        } else {

            return response([
                'message' => 'You can only access your own data. Try /users/'.$authUser->id
            ]);

        }

    }
}
