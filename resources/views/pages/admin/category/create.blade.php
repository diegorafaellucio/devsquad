@extends('layouts.admin')

@section('entity-content')
    <div class="container">
        <h2>Create A Category</h2><br/>
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
        <form method="post" action="{{url('admin/category')}}">
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
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>

@stop