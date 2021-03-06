@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Publish Your Clothes') }}</div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('error') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Categories') }}</label>
                                <div class="col-md-6">
                                    <select name="category" class="form-control">
                                        <option value="0" disabled="true" selected="true">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="brand"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Brand') }}</label>
                                <div class="col-md-6">
                                    <select name="brand" class="form-control">
                                        <option value="0" disabled="true" selected="true">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="clothes"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Clothes') }}</label>
                                <div class="col-md-6">
                                    <select name="cloth" class="form-select" id="id">
                                        <option value="0" disabled="true" selected="true">Clothes</option>
                                        @foreach($clothes as $cloth)

                                            <option value="{{$cloth->id}}">{{$cloth->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="size"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Size') }}</label>
                                <div class="col-md-6">
                                    <select name="size" class="form-select" id="id">
                                        <option value="0" disabled="true" selected="true">Size</option>
                                        @foreach($sizes as $size)

                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="color"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Color') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="id" name="color">
                                        <option value="0" disabled="true" selected="true">Color</option>
                                        @foreach($colors as $color)

                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="materials"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Materials') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="id" name="material">
                                        <option value="0" disabled="true" selected="true">Material</option>
                                        @foreach($materials as $material)

                                            <option value="{{$material->id}}">{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="price"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input type="number" name="price" step="0.01" class="form-control" placeholder="???">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">

                                    <textarea name="description" class="form-control" maxlength="255"
                                              placeholder="Description"> </textarea>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="images"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Images') }}</label>
                                <div class="col-md-6">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image[]"
                                           multiple accept="image/*">

                                    @if ($errors->has('files'))
                                        @foreach ($errors->get('files') as $error)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $error }}</strong>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-6">
                                <div class="col-md-6 offset-md-4 text-md-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Publish') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
