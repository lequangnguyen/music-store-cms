@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Add new Artist
        </h1>
    </section>
    <form role="form" enctype="multipart/form-data"
          action="{{ isset($artist) ? route('Admin::artist@update', [$artist->id] ): route('Admin::artist@store') }}"
          method="POST">
        {{ csrf_field() }}
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
                <input type="text" class="form-control" name="name" placeholder="Enter artist name"
                       value="{{ old('name') ?: @$artist->name }}"/>
            </div>
            <div class="form-group">
                <label>Type</label>
                <div>
                    <select class="form-control" name="type">
                        <option value="">--Choose type--</option>
                        <option value="1" {{ (isset($artist) and ($artist->type==1 )) ? ' selected="selected"' : ''  }}>Band</option>
                        <option value="2" {{ (isset($artist) and ($artist->type==2 )) ? ' selected="selected"' : ''  }}>Solo Performer</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" name="description" placeholder="Enter description about artist"
                       value="{{ old('description') ?: @$artist->description }}"/>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                @if(isset($artist))
                    <p><img width="100px" src="/storage{{$artist['image']}}"/></p>
                @endif
                <input type="file" name="image" id="image">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ isset($artist) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
@endsection
