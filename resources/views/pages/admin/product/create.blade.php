@extends('layouts.admin')

@section('entity-content')
    <div class="container">
        <h2>Create A Product</h2><br/>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br/>
        @endif
        <form method="post" action="{{url('admin/product')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" name="description"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" name="price">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4">
                    <label for="category">Category:</label>
                    <select class="form-control" name="category">
                        <option value="">Selecione uma categoria</option>
                        @foreach($categories as $category)
                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>


    </div>

@stop