<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use GuzzleHttp\Handler\Proxy;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->except(['_method', '_token']);

        if ($request->hasFile('file')) {

            $image = $request->file('file');

            $imageName = time() . $image->getClientOriginalName();
            
            $image->move('admin/images/products', $imageName);
            $data['image_path'] = $imageName;

            Product::create($data);
            return back()->with('status', 'create success');
        } else {
            return back()->with('status', 'create error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $data = $request->except(['_method', '_token']);
        $image = $request->file('file');

        if ($image) {
            $imageName = time() . $image->getClientOriginalName();
            
            $data['image_path'] = $imageName;
        }

        if($product->update($data)){
            if($image){
                
                $image->move('admin/images/products', $imageName);
                
            }
            return back()->with('status', 'update success');
        } else {
            return back()->with('status', 'update error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('status', 'delete success');
    }
}
