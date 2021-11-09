<?php

namespace App\Http\Controllers;

use App\Http\Requests\PalletStoreRequest;
use Illuminate\Http\Request;
use App\Models\Pallet;

class PalletsController extends Controller
{
    public function add(Pallet $pallet, PalletStoreRequest $data)
    {

        $pallet->create($data->validated());
    }
}
