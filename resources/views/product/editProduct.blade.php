@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Publish') }}</div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('product.update', $product->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="title" class="form-control" value="{{$product->title}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" value="{{$product->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Categories') }}</label>
                                <div class="col-md-6">

                                    <select name="category" class="form-control">
                                        @foreach($categories as $category)
                                            @if($category->id == $product->category_id)
                                                <option value="{{$category->id}}"
                                                        selected="true">{{$category->name}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Brand') }}</label>
                                <div class="col-md-6">
                                    <select name="brand" class="form-control">
                                        @foreach($brands as $brand)
                                            @if($brand->id == $product->brand_id)
                                                <option value="{{$brand->id}}" selected="true">{{$brand->name}}</option>
                                            @else
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Clothes') }}</label>
                                <div class="col-md-6">
                                    <select name="cloth" class="form-select" id="id">
                                        @foreach($clothes as $cloth)
                                            @if($cloth->id == $product->cloth_id)
                                                <option value="{{$cloth->id}}" selected="true">{{$cloth->name}}</option>
                                            @else
                                                <option value="{{$cloth->id}}">{{$cloth->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Size') }}</label>
                                <div class="col-md-6">
                                    <select name="size" class="form-select" id="id">
                                        @foreach($sizes as $size)
                                            @if($size->id == $product->size_id)
                                                <option value="{{$size->id}}" selected="true">{{$size->name}}</option>
                                            @else
                                                <option value="{{$size->id}}">{{$size->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Color') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="id" name="color">
                                        @foreach($colors as $color)
                                            @if($color->id == $product->color_id)
                                                <option value="{{$color->id}}" selected="true">{{$color->name}}</option>
                                            @else
                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Materials') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="id" name="material">
                                        @foreach($materials as $material)
                                            @if($material->id == $product->material_id)
                                                <option value="{{$material->id}}"
                                                        selected="true">{{$material->name}}</option>
                                            @else
                                                <option value="{{$material->id}}">{{$material->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input type="number" name="price" class="form-control" value="{{$product->price}}">
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">

                                    <textarea name="description" class="form-control"
                                              maxlength="255">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label for="category"
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
                    @foreach($images as $image)
                        <div class="grid">
                            <div class="inner-card">
                                <form method="POST" action="{{route('deleteImage', $image->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" value="{{$image->id}}">
                                    <img src="{{URL::to($image->image)}}" class="card-img-top">
                                    <input type="submit" value="delete" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
