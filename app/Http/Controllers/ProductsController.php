<?php

namespace App\Http\Controllers;

use App\Models\brands;
use App\Models\categories;
use App\Models\clothes;
use App\Models\colors;
use App\Models\comments;
use App\Models\favourite_products;
use App\Models\images;
use App\Models\materials;
use App\Models\News;
use App\Models\products;
use App\Models\sizes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['images'] = images::all();
        $data['products'] = products::paginate(3);
        return view('product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = categories::all();
        $data['clothes'] = clothes::all();
        $data['colors'] = colors::all();
        $data['brands'] = brands::all();
        $data['sizes'] = sizes::all();
        $data['materials'] = materials::all();
        return view('product.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new products();
        $product->title = $request->post('title');
        $product->name = $request->post('name');
        $product->slug = Str::slug($product->title);
        $product->description = $request->post('description');
        $product->price = $request->post('price');
        $product->user_id = Auth::id();
        $product->category_id = $request->post('category');
        $product->cloth_id = $request->post('cloth');
        $product->color_id = $request->post('color');
        $product->brand_id = $request->post('brand');
        $product->size_id = $request->post('size');
        $product->material_id = $request->post('material');
        $product->views = 0;
        $product->status_id = 1;
        $product->save();

        $id = $product->id;
        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'images/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                images::insert([
                    'image' => $image_url,
                    'product_id' => $id,
                ]);
            }
        }
        return back()->with('success', 'Post created');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\products $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $data['favoredProduct'] = favourite_products::where('product_id', $id)->where('user_id', $userId)->get();
        $data['comments'] = comments::where('product_id', $id)->get();
        $data['images'] = images::where('product_id', $id)->get();

        $product = products::where('id', $id)->get();
        foreach ($product as $item) {
            $item->views += 1;
            $data['product'] = $item;
            $item->save();
        }

        return view('product.singleProduct', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\products $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = products::find($id);
        $data['categories'] = categories::all();
        $data['clothes'] = clothes::all();
        $data['colors'] = colors::all();
        $data['brands'] = brands::all();
        $data['sizes'] = sizes::all();
        $data['materials'] = materials::all();
        $data['images'] = images::where('product_id', $id)->get();


        return view('product.editProduct', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\products $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = products::where('id', $id)->get();
        foreach ($products as $product) {
            $product->title = $request->post('title');
            $product->name = $request->post('name');
            $product->slug = Str::slug($product->title);
            $product->description = $request->post('description');
            $product->price = $request->post('price');
            $product->user_id = Auth::id();
            $product->category_id = $request->post('category');
            $product->cloth_id = $request->post('cloth');
            $product->color_id = $request->post('color');
            $product->brand_id = $request->post('brand');
            $product->size_id = $request->post('size');
            $product->material_id = $request->post('material');
            $product->views = 0;
            $product->status_id = 1;
            $product->save();
        }
        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path = 'public/images/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                images::insert([
                    'image' => $image_url,
                    'product_id' => $id,
                ]);
            }
        }
        return back()->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\products $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        //
    }

    public function favouriteProduct($id)
    {
        $favourite = new favourite_products();
        $favourite->user_id = Auth::id();
        $favourite->product_id = $id;
        $favourite->save();
        return Redirect::back();
    }

    public function unfavouriteProduct($id)
    {
        $userId = Auth::id();
        $favourite = favourite_products::where('user_id', $userId)->where('product_id', $id);
        $favourite->delete();
        return Redirect::back();
    }

    public function popularProducts()
    {
        $data['products'] = products::orderBy('views', 'desc')->paginate(15)->all();
        $data['images'] = images::all();
        return view('product.popular', $data);
    }

    public function newestProducts()
    {
        $data['products'] = products::orderBy('id', 'desc')->paginate(15)->all();
        $data['images'] = images::all();
        return view('product.newest', $data);
    }

    public function userFavouritesProducts()
    {
        $userId = Auth::id();
        $data['favourites'] = favourite_products::where('user_id', $userId)->get();
        $data['products'] = products::all();
        $data['images'] = images::all();
        return view('user.favourite', $data);

    }

    public function usersProducts($id)
    {
        $data['products'] = products::where('user_id', $id)->where('status_id', 1)->get();
        return view('user.productList', $data);
    }

    public function deactivate(Request $request)
    {
        $productsIds = $request->post('check');
        if ($productsIds != null) {
            foreach ($productsIds as $productId) {
                $product = products::find($productId);
                $product->status_id = 2;
                $product->save();
            }
        }
        return Redirect::back();
    }

}
