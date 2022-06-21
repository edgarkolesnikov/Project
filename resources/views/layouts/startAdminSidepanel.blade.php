{{--    @if(Auth::user()->role_id == 3)--}}
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light">Settings</div>
        <div class="list-group list-group-flush">

            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('admin.index')}}">User List</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('admin.products')}}">Product list</a>
        </div>
    </div>
    <!-- Page content wrapper-->



