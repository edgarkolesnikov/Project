<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Products;
use App\Models\Ratings;
use App\Models\User_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['user'] = Auth::user();
        $data['cities'] = Cities::all();
        return view('user.userProvideDetails', $data);
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
            'last_name' => 'required|string|max:255',
            'city' => 'required',
            'address' => 'required|string|max:255',

        ]);
        if ($validator->fails()) {
            return back()->with('error', 'All field must be filled.');
        } else {
            $user_details = new User_details();
            $user_details->user_id = Auth::id();
            $user_details->last_name = $request->post('last_name');
            $user_details->city_id = $request->post('city');
            $user_details->address = $request->post('address');
            $user_details->save();
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User_details $user_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = Auth::user();
        $data['userDetails'] = User_details::where('user_id', $id)->first();
        $data['cities'] = Cities::all();
        return view('user.userDetailsUpdate', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User_details $user_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'city' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'All field must be filled in');
        } else {
            $user_details = User_details::where('user_id', $id)->get();
            foreach ($user_details as $user_detail) {
                $user_detail->last_name = $request->post('last_name');
                $user_detail->city_id = $request->post('city');
                $user_detail->address = $request->post('address');
                $user_detail->save();
            }
            $request->validate([
                'name' => 'required|min:4|string|max:255',
            ]);
            $user = Auth::user();
            $user->name = $request->post('name');
            $user->save();
            return back()->with('success', 'Profile Updated');
        }
    }

    public function userProfile($id)
    {
        $data['sold'] = Products::where('user_id', $id)->where('status_id', '2')->count();
        $data['currently_selling'] = Products::where('user_id', $id)->where('status_id', '1')->count();
        $rating = Ratings::where('user_id', $id)->pluck('grade')->avg();
        $data['rating'] = Round($rating, 2);
        $data['reviews'] = Ratings::where('user_id', $id)->get();
        $data['user'] = \App\Models\User::find($id);
        $data['userDetails'] = User_details::where('user_id', $id)->get();
        $data['userRatings'] = Ratings::where('user_id', $id)->get();
        $data['checkIfRated'] = Ratings::where('user_id', $id)->where('estimator_id', Auth::id())->get();
        return view('user.userProfile', $data);
    }

    public function userReviews($id)
    {
        $data['reviews'] = Ratings::where('user_id', $id)->get();
        return view('user.reviews', $data);
    }
}
