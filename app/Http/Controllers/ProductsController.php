<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Clothes;
use App\Models\Colors;
use App\Models\Comments;
use App\Models\Favourite_products;
use App\Models\Images;
use App\Models\Materials;
use App\Models\Products;
use App\Models\Sizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
        $data['images'] = Images::all();
        $data['products'] = Products::where('status_id', 1)->paginate(12);
        return view('product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Categories::all()->sortBy('name');
        $data['clothes'] = Clothes::all()->sortBy('name');
        $data['colors'] = Colors::all()->sortBy('name');
        $data['brands'] = Brands::all()->sortBy('name');
        $data['sizes'] = Sizes::all()->sortBy('name');
        $data['materials'] = Materials::all()->sortBy('name');
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:95',
            'name' => 'required|max:255',
            'price' => 'required',
            'description' => 'required|max:255',
            'category' => 'required',
            'cloth' => 'required',
            'color' => 'required',
            'brand' => 'required',
            'size' => 'required',
            'material' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'All field must be filled in, post is not created.');
        } else {

            $product = new Products();
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
                    Images::insert([
                        'image' => $image_url,
                        'product_id' => $id,
                    ]);
                }
            } else {
                $oldPath = 'images/999default.jpeg';
                $newPath = 'images/' . md5(rand(1, 10020)). '999default' . rand(78, 9889) . '.jpeg';
                File::copy($oldPath, $newPath);
                Images::insert([
                    'image' => $newPath,
                    'product_id' => $id
                ]);
            }

            return back()->with('success', 'Post created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $data['favoredProduct'] = Favourite_products::where('product_id', $id)->where('user_id', $userId)->get();
        $data['comments'] = Comments::where('product_id', $id)->get();
        $data['images'] = Images::where('product_id', $id)->orderBy('id', 'desc')->get();

        $product = Products::where('id', $id)->where('status_id', 1)->get();
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
     * @param \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Products::find($id);
        $data['categories'] = Categories::all();
        $data['clothes'] = Clothes::all();
        $data['colors'] = Colors::all();
        $data['brands'] = Brands::all();
        $data['sizes'] = Sizes::all();
        $data['materials'] = Materials::all();
        $data['images'] = Images::where('product_id', $id)->get();


        return view('product.editProduct', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Products $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:95',
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string|max:255',
            'category' => 'required',
            'cloth' => 'required',
            'color' => 'required',
            'brand' => 'required',
            'size' => 'required',
            'material' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'All field must be filled in, post is not updated.');
        } else {
            $products = Products::where('id', $id)->get();
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
                    $upload_path = 'images/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);
                    Images::insert([
                        'image' => $image_url,
                        'product_id' => $id,
                    ]);
                }
            }
            return back()->with('success', 'Post Updated');
        }
    }

    public function favouriteProduct($id)
    {
        $favourite = new Favourite_products();
        $favourite->user_id = Auth::id();
        $favourite->product_id = $id;
        $favourite->save();
        return Redirect::back();
    }

    public function unfavouriteProduct($id)
    {
        $userId = Auth::id();
        $favourite = Favourite_products::where('user_id', $userId)->where('product_id', $id);
        $favourite->delete();
        return Redirect::back();
    }

    public function popularProducts()
    {
        $data['images'] = Images::all();
        $data['products'] = Products::where('status_id', 1)->orderBy('views', 'desc')->paginate(12);
        return view('product.popular', $data);
    }

    public function newestProducts()
    {
        $data['images'] = Images::all();
        $data['products'] = Products::where('status_id', 1)->orderBy('id', 'desc')->paginate(12);
        return view('product.newest', $data);
    }

    public function userFavouritesProducts()
    {
        $userId = Auth::id();
        $data['favourites'] = Favourite_products::where('user_id', $userId)->get();
        if ($data['favourites']->isEmpty()) {
            return Redirect('/');
        }
        $data['products'] = Products::where('status_id', 1)->get();
        $data['images'] = Images::all();
        return view('user.favourite', $data);
    }

    public function usersProducts($id)
    {
        $data['products'] = Products::where('user_id', $id)->where('status_id', 1)->get();
        return view('user.productList', $data);
    }

    public function deactivate(Request $request)
    {
        #changing product status, makes products not visible to users and counts as 'sold product'
        $productsIds = $request->post('check');
        if ($productsIds != null) {
            foreach ($productsIds as $productId) {
                $product = Products::find($productId);
                $product->status_id = 2;
                $product->save();
            }
        }
        return Redirect::back();
    }

    public function userListing($id)
    {
        #show another users uploaded products
        $data['images'] = Images::all();
        $data['products'] = Products::where('user_id', $id)->where('status_id', 1)->paginate(12);
        return view('product.userListing', $data);
    }

    public function myProducts()
    {
        #show users only uploaded products
        $id = Auth::id();
        $data['products'] = Products::where('user_id', $id)->where('status_id', 1)->paginate(12);
        $data['images'] = Images::all();
        return view('product.myProducts', $data);
    }
}
