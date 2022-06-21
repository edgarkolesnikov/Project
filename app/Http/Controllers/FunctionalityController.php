<?php

namespace App\Http\Controllers;

use App\Models\images;
use App\Models\News;
use App\Models\products;
use App\Models\sizes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class FunctionalityController extends Controller
{
    public function sizeByClothes(Request $request)
    {
        $data = sizes::select('name', 'id')->where('cloth_id', $request->id)->get();
        return response()->json($data);
    }

    public function search(Request $request)
    {
        $search = $request->post('search');
        $products = products::where('title', 'LIKE', '%'. $search . '%')->
        orwhere('name', 'LIKE', '%'. $search . '%')->
        orwhere('description', 'LIKE', '%'. $search . '%')->get();
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
}


