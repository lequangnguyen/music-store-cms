@extends('admin.layouts.main')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title" style="font-size: 20px">Categories Table</h1>
                <div ><a href="{{ route('Admin::category@add') }}" style="color: #cc0000;float: right;font-size: 16px">Add a new category</a></div>

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
                        <th>Description</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td><img width="100px" src="../upload/category_image/{{$category->image}}"/></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i><a
                                        href="{{ route('Admin::category@edit',[$category->id]) }}">Edit</a></td>
                            <td class="center"><i class="fa fa-trash-o fa-fw"></i><a
                                        href="{{ route('Admin::category@delete',[$category->id]) }}">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>
                </table>
                {{ $categories->links() }}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection