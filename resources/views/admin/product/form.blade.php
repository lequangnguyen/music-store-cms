@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            {{ isset($product) ? "Update product: $product->name" : "Add a new product" }}
        </h1>
    </section>
    <form role="form" enctype="multipart/form-data"
          action="{{ isset($product) ? route('Admin::product@update', [$product->id] ): route('Admin::product@store') }}"
          method="POST">
        {{ csrf_field() }}
        {{--@if (isset($product))
            <input type="hidden" name="_method" value="PUT">
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
                <input type="text" class="form-control" name="name" placeholder="Enter category name"
                       value="{{ old('name') ?: @$product->name }}"/>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" name="description"
                       placeholder="Enter description about product"
                       value="{{ old('description') ?: @$product->description }}"/>
            </div>
            <div class="form-group">
                <label>Category</label>
                <div>
                    <select class="form-control" name="category_id">
                        <option value="">--Choose category for the product--</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ (isset($product) and ($category->id==$product->category_id )) ? ' selected="selected"' : ''  }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" name="price"
                       value="{{ old('price') ?: @$product['price'] }}"
                       placeholder="Price" step="any" required>
            </div>
            <div class="form-group">
                <label for="main">Image</label>
                @if(isset($product))
                   <p><img width="100px" src="../../../upload/product_image/{{$product['image']}}"/></p>
                @endif
                <input type="file" name="main_picture" id="main">
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
@endsection
