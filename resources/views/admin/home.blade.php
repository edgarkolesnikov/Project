@extends('layouts.app')

@section('content')
    @include('layouts.startAdminSidepanel')

    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Role</th>
                <th scope="col">Registered since</th>
                <th scope="col"># of Products</th>
                <th scope="col">Comments written</th>
                <th scope="col">Favoured</th>

            </tr>
            </thead>

            <form action="{{route('admin.userRoleUpdate')}}" method="POST">
                @foreach($users as $user)
                    <tbody>
                    @csrf
                    <tr>
                        <th>{{$user->id}}</th>
                        <th>{{$user->name}}</th>
                        <th>{{$user->details->last_name}}</th>
                        <input type="hidden" name="user_id[]" value="{{$user->id}}">
                            <th><select name="role[]" class="standard-select">
                                    @foreach($roles as $role)
                                        @if($user->role_id == $role->id)
                                            <option value="{{$role->id}}" selected="true">{{$role->name}}</option>
                                        @else
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endif
                                    @endforeach
                                </select></th>
                        <th>{{$user->created_at}}</th>
                        <th>{{count($user->product)}}</th>
                        <th>{{count($user->comments)}}</th>
                        <th>{{count($user->favouriteProducts)}}</th>
                    </tr>
                    @endforeach
                    </tbody>
                    <input type="submit" value="Update">
            </form>
        </table>
    </div>
    @include('layouts.endAdminSidePanel')
@endsection
