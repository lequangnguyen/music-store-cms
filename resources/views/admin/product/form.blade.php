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
                <input type="text" class="form-control" name="name" placeholder="Enter product name"
                       value="{{ old('name') ?: @$product->name }}"/>
            </div>
            <div class="form-group">
                <label>Short Description</label>
                <input type="text" class="form-control" name="short_description"
                       placeholder="Enter short description about product"
                       value="{{ old('short_description') ?: @$product->short_description }}"/>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="editor1" rows="10" cols="80" class="form-control" name="description"
                          placeholder="Enter description about product">{{ old('description') ?: @$product->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <div>
                    <select class="form-control" name="category_id">
                        <option value="">--Choose category for the product--</option>
                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}" {{ (isset($product) and ($category->id==$product->category_id )) ? ' selected="selected"' : ''  }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Artist</label>
                <div>
                    <select class="form-control" name="artist_id">
                        <option value="">--Choose artist--</option>
                        @foreach($artists as $artist)
                            <option
                                value="{{$artist->id}}" {{ (isset($product) and ($artist->id==$product->artist_id )) ? ' selected="selected"' : ''  }}>{{$artist->name}}</option>
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
                <label>Start Time</label>
                <input type="datetime-local" class="form-control" name="start_time"
                       value="{{ old('start_time') ?: @date('Y-m-d\TH:i', strtotime($product['start_time'])) }}"
                       placeholder="Start Time">
            </div>
            <div class="form-group">
                <label>End Time</label>
                <input type="datetime-local" class="form-control" name="end_time"
                       value="{{ old('end_time') ?: @date('Y-m-d\TH:i', strtotime($product['end_time'])) }}"
                       placeholder="End Time">
            </div>
            <div class="form-group">
                <label>Release Year</label>
                <input type="number" class="form-control" name="release_year"
                       value="{{ old('release_year') ?: @$product['release_year'] }}"
                       placeholder="Release Year" required>
            </div>
            <div class="form-group">
                <label for="main">Image</label>
                @if(isset($product))
                    <p><img width="100px" src="/storage{{$product['image']}}"/></p>
                @endif
                <input type="file" name="image" id="main">
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
@endsection
