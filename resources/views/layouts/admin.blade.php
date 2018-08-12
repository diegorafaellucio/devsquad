@extends('layouts.app')

@section('content')

    <div id="sidenav" class="sidenav">
        <a href="{{ url('/admin/category') }}">Categories</a>
        <a href="{{ url('/admin/product') }}">Products</a>
    </div>


    <div id="main" class="main">
        @yield('entity-content')
    </div>



@stop