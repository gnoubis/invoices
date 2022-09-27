<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class customerController extends Controller
{

    public function all_customers()
    {
        $customers = customer::orderBy('id','DESC')->get();

        return response()->json([
            'customers' => $customers
        ],200);
    }
}
