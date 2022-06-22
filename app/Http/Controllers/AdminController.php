<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\products;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{


    public function index()
    {
        if(Auth::user()->role_id != '2'){
            return redirect('/');
        }
        $data['roles'] = roles::all();
        $data['users'] = User::all();
        return view('admin.home', $data);
    }

    public function products()
    {
        if(Auth::user()->role_id != '2'){
            return redirect('/');
        }
        $data['products'] = products::all();
        return view('admin.productList', $data);
    }

    public function productDelete(Request $request)
    {
        $productsIds = $request->post('check');
        if ($productsIds != null) {
            foreach ($productsIds as $productId) {
                $product = products::find($productId);
                $product->delete();
            }
        }
        return Redirect::back();
    }

    public function userRoleUpdate(Request $request)
    {
        $userId = $request->post('user_id');
        $role = $request->post('role');
        $count = count($userId);

        for ($i = 0; $i < $count; $i++) {
            $user = User::find($userId[$i]);
            $user->role_id = $role[$i];
            $user->save();
        }
        return Redirect::back();
    }

    public function userComments()
    {
        if(Auth::user()->role_id != '2'){
            return redirect('/');
        }
        $data['comments'] = comments::all();
        return view('admin.comments', $data);
    }
}
