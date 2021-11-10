<?php

namespace App\Http\Controllers;

use App\Services\Barcode;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class BarcodeController extends Controller
{
    public function calc()
    {
        $barcode = Request::all()['barcode'];
        // ddd($barcode);
        $bc = new Barcode();

        $barcode .= $bc->checkDigit($barcode);

        return Inertia::render('Barcode/CheckDigit', [
            'barcode' => $barcode,
            'length' => strlen($barcode)
        ]);
    }

    public function show()
    {

        return Inertia::render('Barcode/CheckDigit');
    }
}
