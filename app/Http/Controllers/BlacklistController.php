<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlacklistIPAddressRequest;
use App\Models\BlacklistedIPAddress;

class BlacklistController extends Controller
{
    public function index()
    {
        //
    }

    public function store(BlacklistIPAddressRequest $request)
    {
        //
    }

    public function destroy(BlacklistedIPAddress $ip_address)
    {
        //
    }
}
