<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class productController extends Controller
{

    public function all_product(){

        $products = product::orderBy('id', 'DESC')->get();

        return response()->json([
            'products' => $products
        ],200);

    }
}
