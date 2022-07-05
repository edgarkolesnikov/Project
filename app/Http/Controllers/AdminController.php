<?php

namespace App\Http\Controllers;

use App\Models\brands;
use App\Models\categories;
use App\Models\clothes;
use App\Models\colors;
use App\Models\Comments;
use App\Models\images;
use App\Models\materials;
use App\Models\Products;
use App\Models\Roles;
use App\Models\sizes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        #checking authentication of admin role
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role_id != 2) {
                return redirect('/');
            };

            return $next($request);
        });
    }

    public function index()
    {
        $data['roles'] = Roles::all();
        $data['users'] = User::all();
        return view('admin.home', $data);
    }

    public function products()
    {
        $data['products'] = Products::all();
        return view('admin.productList', $data);
    }

    public function productDelete(Request $request)
    {
        #product deletion from DB, image deletion from image storage folder.
        $productsIds = $request->post('check');
        if ($productsIds != null) {
            foreach ($productsIds as $productId) {
                $product = Products::find($productId);
                $images = Images::where('product_id', $productId)->get();
                foreach ($images as $img) {
                    if ($img->id != 1) {
                        @unlink($img->image);
                    }
                }
                $product->delete();
            }
        }
        return Redirect::back();
    }

    public function userRoleUpdate(Request $request)
    {
        #Changing user role from admin panel
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
        if (Auth::user()->role_id != '2') {
            return redirect('/');
        }
        $data['comments'] = Comments::all();
        return view('admin.comments', $data);
    }

    public function atributes()
    {
        $data['categories'] = Categories::all()->sortBy('name');
        $data['brands'] = Brands::all()->sortBy('name');
        $data['cloths'] = Clothes::all()->sortBy('name');
        $data['sizes'] = Sizes::all();
        $data['colors'] = Colors::all()->sortBy('name');
        $data['materials'] = Materials::all()->sortBy('name');

        return view('admin.atributesForm', $data);
    }

    public function deleteCategory(Request $request)
    {
        if ($request->post('category') == null) {
            return back();
        }
        $productsWithThisId = products::where('category_id', $request->post('category'))->get();

        if ($productsWithThisId->isEmpty()) {
            $category = Categories::find($request->post('category'));
            $category->delete();
            return back()->with('success', 'Atribute Deleted');
        }
        return back()->with('error', 'Cant delete, atribute in use');

    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|unique:categories,name'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Existing or empty entry');
        } else {
            $category = new Categories();
            $category->name = $request->post('category');
            $category->save();
            return back()->with('success', 'Category added');
        }
    }

    public function deleteBrand(Request $request)
    {
        if ($request->post('brand') == null) {
            return back();
        }
        $productsWithThisId = products::where('brand_id', $request->post('brand'))->get();

        if ($productsWithThisId->isEmpty()) {
            $brand = Brands::find($request->post('brand'));
            $brand->delete();
            return back()->with('success', 'Brand Deleted');
        }
        return back()->with('error', 'Cant delete, Brand in use');
    }

    public function addBrand(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string|unique:brands,name'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Existing or empty entry');
        } else {
            $brand = new Categories();
            $brand->name = $request->post('brand');
            $brand->save();
            return back()->with('success', 'Brand added');
        }
    }

    public function deleteCloth(Request $request)
    {
        if ($request->post('cloth') == null) {
            return back();
        }
        $productsWithThisId = products::where('cloth_id', $request->post('cloth'))->get();

        if ($productsWithThisId->isEmpty()) {
            $cloth = Clothes::find($request->post('cloth'));
            $cloth->delete();
            return back()->with('success', 'Cloth Deleted');
        }
        return back()->with('error', 'Cant delete, Cloth in use');
    }

    public function addCloth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cloth' => 'required|string|unique:clothes,name'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Existing or empty entry');
        } else {
            $cloth = new Clothes();
            $cloth->name = $request->post('cloth');
            $cloth->save();
            return back()->with('success', 'Cloth added');
        }
    }

    public function deleteSize(Request $request)
    {
        if ($request->post('size') == null) {
            return back();
        }
        $productsWithThisId = products::where('size_id', $request->post('size'))->get();

        if ($productsWithThisId->isEmpty()) {
            $size = Sizes::find($request->post('size'));
            $size->delete();
            return back()->with('success', 'Size Deleted');
        }
        return back()->with('error', 'Cant delete, Size in use');
    }

    public function addSize(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'size' => 'required|string|unique:sizes,name'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Existing or empty entry');
        } else {
            $size = new Sizes();
            $size->name = $request->post('size');
            $size->save();
            return back()->with('success', 'Size added');
        }
    }

    public function deleteColor(Request $request)
    {
        if ($request->post('color') == null) {
            return back();
        }
        $productsWithThisId = products::where('color_id', $request->post('color'))->get();

        if ($productsWithThisId->isEmpty()) {
            $color = Colors::find($request->post('color'));
            $color->delete();
            return back()->with('success', 'Color Deleted');
        }
        return back()->with('error', 'Cant delete, Color in use');

    }

    public function addColor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'color' => 'required|string|unique:colors,name'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Existing or empty entry');
        } else {
            $color = new Colors();
            $color->name = $request->post('color');
            $color->save();
            return back()->with('success', 'Color added');
        }
    }

    public function deleteMaterial(Request $request)
    {
        if ($request->post('material') == null) {
            return back();
        }
        $productsWithThisId = products::where('material_id', $request->post('material'))->get();

        if ($productsWithThisId->isEmpty()) {
            $material = Materials::find($request->post('material'));
            $material->delete();
            return back()->with('success', 'Material Deleted');
        }
        return back()->with('error', 'Cant delete, Material in use');

    }

    public function addMaterial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'material' => 'required|string|unique:materials,name'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Existing or empty entry');
        } else {
            $material = new Materials();
            $material->name = $request->post('material');
            $material->save();
            return back()->with('success', 'Material added');
        }
    }
}
