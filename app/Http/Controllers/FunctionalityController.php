<?php

namespace App\Http\Controllers;

use App\Models\images;
use App\Models\News;
use App\Models\Products;
use App\Models\Ratings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class FunctionalityController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        if ($search === null) {
            return Redirect::back();
        }
        $products = Products::where('status_id', 1)->where('title', 'LIKE', '%' . $search . '%')->
        orwhere('name', 'LIKE', '%' . $search . '%')->
        orwhere('description', 'LIKE', '%' . $search . '%')->
        orwhere('price', '<=', $search)->get();
        $images = [];
        foreach ($products as $product) {
            $photos = Images::where('product_id', $product->id)->first();
            $photo = explode('|', $photos->image);
            $images[] = [
                'product_id' => $product->id,
                'image' => $photo[0]
            ];
        }
        $data['images'] = $images;
        $data['products'] = $products;
        return view('search.list', $data);
    }

    public function deleteImage($id)
    {
        $img = Images::find($id);
        $product_id = $img->product_id;
        if ($img->id != 1) {
            @unlink($img->image);
        }
        $img->delete();

        $images = Images::where('product_id', $product_id)->get();
        if($images->isEmpty()){
            $oldPath = 'images/999default.jpeg';
            $newPath = 'images/' . md5(rand(1, 10020)). '999default' . rand(78, 9889) . '.jpeg';
            File::copy($oldPath, $newPath);
            Images::insert([
                'image' => $newPath,
                'product_id' => $product_id
            ]);
        }
        return Redirect::back();
    }

    public function editPassword()
    {
        return view('user.passwordUpdate');
    }

    public function updatePassword(Request $request)
    {
        #Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        #Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(Auth::id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function filteredProducts(Request $request)
    {
        $data = Products::query();
        if ($request->has('category_id')) {
            $data = $data->where('status_id', 1)->where('category_id', $request->get('category_id'));
        }
        if ($request->has('cloth_id')) {
            $data = $data->where('status_id', 1)->where('cloth_id', $request->get('cloth_id'));
        }
        if ($request->has('size_id')) {
            $data = $data->where('status_id', 1)->where('size_id', $request->get('size_id'));
        }
        if ($request->has('color_id')) {
            $data = $data->where('status_id', 1)->where('color_id', $request->get('color_id'));
        }

        $data = $data->get();
        $images = Images::all();

        return view('search.filteredProducts', ['products' => $data, 'images' => $images]);
    }

    public function rateUserForm($id)
    {
        $rating = Ratings::where('user_id', $id)->where('estimator_id', Auth::id())->get();
        if (!$rating->isEmpty()) {
            return Redirect('user/profile/' . $id);
        }

        $data['userRatings'] = Ratings::where('user_id', $id)->get();
        $data['user'] = User::find($id);
        return view('user.ratingForm', $data);
    }

    public function rateUser(Request $request)
    {
        $rate = new Ratings();
        $rate->estimator_id = Auth::id();
        $rate->user_id = $request->post('user_id');
        $rate->grade = $request->post('rating');
        $rate->review = $request->post('review');
        $rate->save();
        return Redirect('user/profile/' . $request->post('user_id'));
    }
}


