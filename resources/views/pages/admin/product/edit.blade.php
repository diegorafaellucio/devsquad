@extends('layouts.admin')

@section('entity-content')
    <div class="container">
        <h2>Edit A Product</h2><br/>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif


        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{action('ProductController@update', $id)}}">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="row">
                        <div class="col-md-12"></div>
                        <div class="form-group col-md-12">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{$product->name}}">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12"></div>
                        <div class="form-group col-md-12">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description"
                                   value="{{$product->description}}">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12"></div>
                        <div class="form-group col-md-12">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" name="price" value="{{$product->price}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"></div>
                        <div class="form-group col-md-12">
                            <label for="category">Category:</label>
                            <select class="form-control" name="category">
                                <option value="">Selecione uma categoria</option>
                                @foreach($categories as $category)
                                    @if($product->category === $category['id'])
                                        <option selected value="{{$category['id']}}">{{$category['name']}}</option>
                                    @else
                                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                                    @endif
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
                </form>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="form-group col-md-12">
                        <h2>Images</h2><br/>
                        <form method="post" action="{{url('admin/image')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <input type="hidden" name="product" class="form-control" value="{{$id}}" style="padding: 0"/>
                                    <input type="file" name="image" class="form-control" style="padding: 0"/>

                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-success">Add</button>

                                </div>
                            </div>

                        </form>
                        <br/>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <td>{{$image['id']}}</td>
                                    <td><img src="{{ URL::to('/') }}/storage/{{$id}}/{{$image['name']}}"></td>

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
                    </div>
                </div>


            </div>
        </div>


    </div>

@stop