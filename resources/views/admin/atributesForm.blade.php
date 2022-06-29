@extends('layouts.app')

@section('content')
    @include('layouts.startAdminSidepanel')
    <div class="container-fluid">
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
        <table class="table" style="width:100%">
            <tr>
                <th>Category:</th>
                <td>
                    <form method="POST" action="{{route('admin.deleteCategory')}}">
                        @csrf
                        <select name="category">
                            <option value="0" disabled="true" selected="true">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="delete" class="btn-danger">
                    </form>
                </td>
                <form method="POST" action="{{route('admin.addCategory')}}">
                    @csrf
                    <td>
                        <input type="text" name="category" placeholder="New Category">
                        <input type="submit" value="Add">
                    </td>
                </form>
            </tr>
            <tr>
                <th>Brand:</th>
                <td>
                    <form method="POST" action="{{route('admin.deleteBrand')}}">
                        @csrf
                        <select name="brand">
                            <option value="0" disabled="true" selected="true">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="delete" class="btn-danger">
                    </form>
                </td>
                <form method="POST" action="{{route('admin.addBrand')}}">
                    @csrf
                    <td>
                        <input type="text" name="brand" placeholder="New Brand">
                        <input type="submit" value="Add">
                    </td>
                </form>
            </tr>
            <tr>
                <th>Cloth:</th>
                <td>
                    <form method="POST" action="{{route('admin.deleteCloth')}}">
                        @csrf
                        <select name="cloth">
                            <option value="0" disabled="true" selected="true">Select Cloth</option>
                            @foreach($cloths as $cloth)
                                <option value="{{$cloth->id}}">{{$cloth->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="delete" class="btn-danger">
                    </form>
                </td>
                <form method="POST" action="{{route('admin.addCloth')}}">
                    @csrf
                    <td>
                        <input type="text" name="cloth" placeholder="New Cloth">
                        <input type="submit" value="Add">
                    </td>
                </form>
            </tr>
            <tr>
                <th>Size:</th>
                <td>
                    <form method="POST" action="{{route('admin.deleteSize')}}">
                        @csrf
                        <select name="size">
                            <option value="0" disabled="true" selected="true">Select Size</option>
                            @foreach($sizes as $size)
                                <option value="{{$size->id}}">{{$size->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="delete" class="btn-danger">
                    </form>
                </td>
                <form method="POST" action="{{route('admin.addSize')}}">
                    @csrf
                    <td>
                        <input type="text" name="size" placeholder="New Size">
                        <input type="submit" value="Add">
                    </td>
                </form>
            </tr>
            <tr>
                <th>Color:</th>
                <td>
                    <form method="POST" action="{{route('admin.deleteColor')}}">
                        @csrf
                        <select name="color">
                            <option value="0" disabled="true" selected="true">Select Color</option>
                            @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="delete" class="btn-danger">
                    </form>
                </td>
                <form method="POST" action="{{route('admin.addColor')}}">
                    @csrf
                    <td>
                        <input type="text" name="color" placeholder="New Color">
                        <input type="submit" value="Add">
                    </td>
                </form>
            </tr>
            <tr>
                <th>Material:</th>
                <td>
                    <form method="POST" action="{{route('admin.deleteMaterial')}}">
                        @csrf
                        <select name="material">
                            <option value="0" disabled="true" selected="true">Select Material</option>
                            @foreach($materials as $material)
                                <option value="{{$material->id}}">{{$material->name}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="delete" class="btn-danger">
                    </form>
                </td>
                <form method="POST" action="{{route('admin.addMaterial')}}">
                    @csrf
                    <td>
                        <input type="text" name="material" placeholder="New Size">
                        <input type="submit" value="Add">
                    </td>
                </form>
            </tr>
        </table>
    </div>
    @include('layouts.endAdminSidePanel')
@endsection
