@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Add new Category
        </h1>
    </section>
    <form role="form" enctype="multipart/form-data"
          action="{{ isset($category) ? route('Admin::category@update', [$category->id] ): route('Admin::category@store') }}"
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
                <input type="text" class="form-control" name="name" placeholder="Enter category name"
                       value="{{ old('name') ?: @$category->name }}"/>
            </div>
            <div class="form-group">
                <label>Parent Category</label>
                <div>
                    <select class="form-control" name="parent_id">
                        <option value="">--Choose parent for category--</option>
                        @foreach($pr_categories as $pr_category)
                            <option
                                value="{{$pr_category->id}}" {{ (isset($category) and ($pr_category->id==$category->parent_id )) ? ' selected="selected"' : ''  }}>{{$pr_category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" name="description"
                       placeholder="Enter description about category"
                       value="{{ old('description') ?: @$category->description }}"/>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                @if(isset($category))
                    <p><img width="100px" src="/storage{{$category['image']}}"/></p>
                @endif
                <input type="file" name="image" id="image">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
@endsection
