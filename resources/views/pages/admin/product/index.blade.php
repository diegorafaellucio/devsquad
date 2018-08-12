@extends('layouts.admin')

@section('entity-content')
    <div class="container">
        <h4>Products</h4>
        <a href="{{action('ProductController@create')}}" class="btn btn-info">Add</a>
        <button
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#favoritesModal">
            Import
        </button>
        <br/>
        <br/>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br/>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->category_name}}</td>
                    <td><a href="{{action('ProductController@edit', $product->id)}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{action('ProductController@destroy', $product->id)}}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <div class="modal fade" id="favoritesModal"
             tabindex="-1" role="dialog" data-backdrop="false"
             aria-labelledby="favoritesModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title"
                            id="favoritesModalLabel">Add Import File</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('admin/file')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <input type="file" name="file" class="form-control" style="padding: 0"/>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-success">Add</button>

                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>





@stop

