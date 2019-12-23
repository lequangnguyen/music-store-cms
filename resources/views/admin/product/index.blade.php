@extends('admin.layouts.main')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title" style="font-size: 20px">Products Table</h1>
                <div><a href="{{ route('Admin::product@add') }}" style="color: #cc0000;float: right;font-size: 16px">Add
                        a new product</a></div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(session('Notice'))
                    <div class='alert alert-success'>
                        {{session('Notice')}}
                    </div>

                @endif
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->short_description}}</td>
                            <td>
                                @foreach($categories as $category)
                                    @if($category->id==$product->category_id)
                                        {{$category->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$product->price}}</td>
                            <td><img width="100px" src="/storage{{$product->image}}"/></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i><a
                                        href="{{ route('Admin::product@edit',[$product->id]) }}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Edit</th>
                    </tr>
                    </tfoot>
                </table>
                {{ $products->links() }}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
