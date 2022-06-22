@extends('layouts.app')

@section('content')
    @include('layouts.startUserSidepanel')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Details') }}</div>
                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('userDetails.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                                <div class="col-md-6">
                                        <input type="text" name="last_name" class="form-control" value="{{$userDetails->last_name}}">

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="id" name="city">
                                        @foreach($cities as $city)
                                            @if($city->id == $userDetails->city->id)
                                                <option value="{{$city->id}}" selected="true">{{$city->name}}</option>
                                            @else
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="address" class="form-control" value="{{$userDetails->address}}">
                                </div>
                            </div>
                            <div class="row mb-6">
                                <div class="col-md-6 offset-md-4 text-md-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.endUserSidepanel')
@endsection
