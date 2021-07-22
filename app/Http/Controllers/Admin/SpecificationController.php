<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    public function index($id) {
        $product = Product::with('images')->where('id', $id)->get();
        return view('admin.specification.index', compact(['product']));
    }
}
