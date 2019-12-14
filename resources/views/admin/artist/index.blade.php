@extends('admin.layouts.main')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title" style="font-size: 20px">Artists Table</h1>
                <div ><a href="{{ route('Admin::artist@add') }}" style="color: #cc0000;float: right;font-size: 16px">Add a new artist</a></div>

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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($artists as $artist)
                        <tr>
                            <td>{{$artist->id}}</td>
                            <td>{{$artist->name}}</td>
                            <td>{{$artist->description}}</td>
                            <td><img width="100px" src="/storage{{$artist->image}}"/></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i><a
                                        href="{{ route('Admin::artist@edit',[$artist->id]) }}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Edit</th>
                    </tr>
                    </tfoot>
                </table>
                {{ $artists->links() }}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
