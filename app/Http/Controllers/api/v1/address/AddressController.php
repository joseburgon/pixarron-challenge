<?php

namespace App\Http\Controllers\api\v1\address;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {

        $addresses = Address::allowed()
            ->with(['user'])
            ->paginate();

        return AddressCollection::make($addresses);

    }


    public function show(Address $address)
    {

        $authUser = auth()->user();

        if ($authUser->hasRole('admin') || $address->user_id === $authUser->id) {

            return AddressResource::make(
                $address->load('user')
            );

        } else {

            return response([
                'message' => 'You don\'t have permission to access this information.'
            ]);

        }

    }
}
