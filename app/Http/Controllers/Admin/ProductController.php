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
use App\Models\OrderDetail;
use App\Models\Specification;
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
                $specification = $request->except(['_method', '_token', 'name', 'price', 'quantity', 'category_id']);
                $product->images()->insert($array);
                $product->specification()->create($specification);
                // dd($array);
                DB::commit();
            }
            // Insert new resource in images table with data = $array by using relationship

            // All OK then commit

        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();
            // return redirect back with session error
            return back()->with('status', 'Vui l??ng th??m ??i???n ?????y ????? c??c tr?????ng y??u c???u!');
        }
        // return route manager room with session 'create success'
        return back()->with('status', 'Th??m s???n ph???m th??nh c??ng');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('images')->select('products.*', 'categories.name as category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', $id)->first();
        $specification = Specification::where('product_id', $id)->get();
        return view('admin.products.show', compact(['product', 'specification']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['specification', 'images', 'category'])
                            ->where('id', $id)->first();
        $categories = Category::all();
        // dd($product->toArray());
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
        DB::beginTransaction();

        try {
            $product = Product::find($id);

            if($request->hasFile('files')) {
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
                    $product->specification()->update($request->except(['name','files', 'price', 'quantity', 'category_id', '_method', '_token']));
                }
            } else {
                $product->update($request->only(['name', 'price', 'quantity', 'category_id']));
                $product->specification()->update($request->except(['name', 'price', 'quantity', 'category_id', '_method', '_token']));
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return back()->with('status', 'C?? l???i x???y ra');
            // something went wrong
        }
        return back()->with('status', 'C???p nh???t th??nh c??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = OrderDetail::where('product_id', $id)->get();

        if(count($product) > 0){
            return back()->with('status', 'S???n ph???m ??ang c?? trong ????n h??ng, kh??ng th??? x??a');
        } else{
            $images = Image::where('product_id', $id)->get();
            foreach($images as $key => $image){
                $imagePath = 'admin/images/products/' . $image->path;
                File::delete($imagePath);
            }
            Image::where('product_id', $id)->delete();
            Specification::where('product_id', $id)->delete();
            Product::destroy($id);
            return back()->with('status', 'X??a s???n ph???m th??nh c??ng');
        }

    }

}
