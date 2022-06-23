<?php

namespace App\Http\Controllers;

use App\Models\images;
use App\Models\News;
use App\Models\products;
use App\Models\ratings;
use App\Models\sizes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class FunctionalityController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->post('search');
        if($search === null){
            return Redirect::back();
        }
        $products = products::where('title', 'LIKE', '%'. $search . '%')->
        orwhere('name', 'LIKE', '%'. $search . '%')->
        orwhere('description', 'LIKE', '%'. $search . '%')->
        orwhere('price', '<=', $search )->get();
        $images = [];
        foreach($products as $product){
            $photos = images::where('product_id', $product->id)->first();
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
        images::where('id', $id)->delete();
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
        if(!Hash::check($request->old_password, Auth::user()->password)){
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
        $array = [
            'category_id' => $request->post('category_id'),
            'cloth_id' => $request->post('cloth_id'),
            'size_id' => $request->post('size_id'),
            'color_id' => $request->post('color_id'),
        ];
        $collection = array_filter($array);
        foreach ($collection as $key => $atribute) {
            if($atribute == null){
                $data['products'] = products::select($key)->get();
            }else {
                $data['products'] = products::where($key, $atribute)->get();
            }
        }
        if(empty($data['products'])){
            return redirect()->route('home');
        }
        $data['images'] = images::all();
        return view('search.filteredProducts', $data);
    }

    public function rateUserForm($id)
    {
        $rating = ratings::where('user_id', $id)->where('estimator_id', Auth::id())->get();
        if(!$rating->isEmpty()){
            return Redirect('user/profile/'.$id);
        }

        $data['userRatings'] = ratings::where('user_id', $id)->get();
        $data['user'] = User::find($id);
        return view('user.ratingForm', $data);
    }

    public function rateUser(Request $request)
    {
        $rate = new ratings();
        $rate->estimator_id = Auth::id();
        $rate->user_id = $request->post('user_id');
        $rate->grade = $request->post('rating');
        $rate->review = $request->post('review');
        $rate->save();
        return Redirect('user/profile/'.$request->post('user_id'));
    }
}


