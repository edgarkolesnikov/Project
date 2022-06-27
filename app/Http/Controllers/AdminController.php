<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Products;
use App\Models\Roles;
use App\Models\User;
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
        $data['roles'] = Roles::all();
        $data['users'] = User::all();
        return view('admin.home', $data);
    }

    public function products()
    {
        if(Auth::user()->role_id != '2'){
            return redirect('/');
        }
        $data['products'] = Products::all();
        return view('admin.productList', $data);
    }

    public function productDelete(Request $request)
    {
        $productsIds = $request->post('check');
        if ($productsIds != null) {
            foreach ($productsIds as $productId) {
                $product = Products::find($productId);
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
        $data['comments'] = Comments::all();
        return view('admin.comments', $data);
    }
}
