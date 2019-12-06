@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Add new User
        </h1>
    </section>
    <form role="form" enctype="multipart/form-data" action="{{ isset($user) ? route('Admin::user@update', [$user->id] ): route('Admin::user@store') }}"
          method="POST">
        {{ csrf_field() }}
        {{--<input type="hidden" name="_token" value='{{csrf_token()}}'/>--}}
        {{--@if (isset($user))
            <input type="hidden" name="_method" value="POST">
        @endif--}}
        <div class="box-body">
            @if(count($errors)>0)
                <div class='alert alert-danger'>
                    @foreach($errors->all() as $err)
                        {{$err}}<br/>
                    @endforeach
                </div>
            @endif
            @if(session('Notice'))
                <div class='alert alert-success'>
                    {{session('Notice')}}
                </div>

            @endif
            <div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old('name') ?: @$user->name }}"/>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }}">
                <label>Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') ?: @$user->email }}"/>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }}">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password')}}"/>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="passwordAgain" placeholder="Confirm Password" value="{{ old('passwordAgain') }}"/>
            </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
@endsection