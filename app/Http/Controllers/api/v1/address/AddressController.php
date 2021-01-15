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
        $addresses = Address::with(['user'])->paginate();

        return AddressCollection::make($addresses);
    }


    public function show(Address $address)
    {
        return AddressResource::make(
            $address->load('user')
        );
    }
}
