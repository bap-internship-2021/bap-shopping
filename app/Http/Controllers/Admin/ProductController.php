<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->paginate(3);
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

        // start transaction
        DB::beginTransaction();
        try {

            // If request has file upload
            if ($request->hasFile('files')) {
                // create new room in rooms table
                $product = Product::create($request->only(['name', 'price', 'quantity', 'category_id']));

                foreach ($request->file('files') as $key => $image) {
                    // Get file name inclue extention
                    $imageName = time() . $image->getClientOriginalname();
                    // Declare target dir contain image in public/images/rooms forder
                    $target_dir = 'admin/images/products';
                    // Move images to target dir
                    $image->move($target_dir, $imageName);
                    // Add information to array for store new resource in images table
                    $array[$key]['path'] = $imageName;
                    $array[$key]['created_at'] = now();
                    $array[$key]['updated_at'] = now();
                    $array[$key]['product_id'] = $product->id;
                }

                $product->images()->insert($array);
                // dd($array);
                DB::commit();
            }
            // Insert new resource in images table with data = $array by using relationship


            // All OK then commit

        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();
            // return redirect back with session error
            return back()->with('status', 'create fail');
        }
        // return route manager room with session 'create success'
        return back()->with('status', 'create success');
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
        $images = Image::where('product_id', $id)->get();
        $categories = Category::all();
        return view('admin.products.edit', compact(['product', 'categories', 'images']));
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
        // $product = Product::find($id);
        // $data = $request->except(['_method', '_token']);

        DB::beginTransaction();

        try {
            $product = Product::find($id);

            if($request->hasFile('files')){

                $images = Image::where('product_id', $id)->get();
                foreach($images as $key => $image){
                    $imagePath = 'admin/images/products/' . $image->path;
                    File::delete($imagePath);
                }
                if(Image::where('product_id', $id)->delete()){

                    $product->update($request->only(['name', 'price', 'quantity', 'category_id']));
                    foreach ($request->file('files') as $key => $image) {
                        // Get file name inclue extention
                        $imageName = time() . $image->getClientOriginalname();
                        // Declare target dir contain image in public/images/rooms forder
                        $target_dir = 'admin/images/products';
                        // Move images to target dir
                        $image->move($target_dir, $imageName);
                        // Add information to array for store new resource in images table
                        $array[$key]['path'] = $imageName;
                        $array[$key]['created_at'] = now();
                        $array[$key]['updated_at'] = now();
                        $array[$key]['product_id'] = $product->id;
                    }
                    $product->images()->insert($array);
                }
            } else {
                $product->update($request->only(['name', 'price', 'quantity', 'category_id']));
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('status', 'update fail');
            // something went wrong
        }
        return back()->with('status', 'update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $images = Image::where('product_id', $id)->get();
            foreach($images as $key => $image){
                $imagePath = 'admin/images/products/' . $image->path;
                File::delete($imagePath);
            }
            Image::where('product_id', $id)->delete();
            Product::destroy($id);
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
        return back()->with('status', 'delete success');
    }
}
