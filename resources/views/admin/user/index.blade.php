@extends('admin.layouts.main')
@section('content-header')
    <section class="content-header">
        <h1>
            USERS MANAGEMENT
        </h1>
    </section>
@endsection
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title" style="font-size: 20px">Users Table</h1>
                <div ><a href="{{ route('Admin::user@add') }}" style="color: #cc0000;float: right;font-size: 16px">Add a new user</a></div>

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
                        <th>Email</th>
                        <th>Password</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->password}}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i><a
                                        href="{{ route('Admin::user@edit',[$user->id]) }}">Edit</a></td>
                            <td class="center"><i class="fa fa-trash-o fa-fw"></i><a
                                        href="{{ route('Admin::user@delete',[$user->id]) }}">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>
                </table>
                {{ $users->links() }}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
