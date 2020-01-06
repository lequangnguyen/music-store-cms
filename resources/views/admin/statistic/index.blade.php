@extends('admin.layouts.main')
@section('content-header')
    <section class="content-header">
        <h1>
            STATISTICS
        </h1>
    </section>
@endsection
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title" style="font-size: 20px">Statistic</h1>
            </div>
            <div class="box-body">
                <form action="{{route('Admin::statistic@getStatistic')}}" method="GET">
{{--                    {{ csrf_field() }}--}}
                    <div class="form-group m-form__group row align-items-center">
                        <div class="col-md-3">
                            <label>Choose date range:</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date-range" value="{{ Request::input('date-range') }}"
                                       class="form-control pull-right"
                                       id="reservation" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Category</label>
                            <div>
                                <select class="form-control" name="category_id">
                                    <option value="">--All category for the product--</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{$category->id}}" {{ ( Request::input('category_id') == $category->id) ? ' selected="selected"' : ''  }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label style="color: white;">Date range:</label>

                            <div class="input-group">
                                <button type="submit" class="btn btn-block btn-default">View statistic</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="form-group m-form__group row align-items-center">
                    @if(isset($total_quantity))
                    <div class="col-md-3">
                        <label>Total Quantity:</label>
                        <div>{{$total_quantity}}</div>
                    </div>
                    @endif
                        @if(isset($total_cost))
                    <div class="col-md-3">
                        <label>Total Cost: </label>
                        <div>${{$total_cost}}</div>
                    </div>
                        @endif

                </div>
                @if(session('Notice'))
                    <div class='alert alert-success'>
                        {{session('Notice')}}
                    </div>
                @endif
                <div>
                    @if(isset($statistics))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statistics as $statistic)
                        <tr>
                            <td>{{$statistic->product_id}}</td>
                            <td>{{$statistic->product_name}}</td>
                            <td>{{$statistic->cate_name}}</td>
                            <td>{{$statistic->quantity_sum}}</td>
                            <td>{{$statistic->cost_sum}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Total Cost</th>
                    </tr>
                    </tfoot>
                </table>
                        {{ $statistics->links() }}
                    @endif
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            //Date range picker
            $('#reservation').daterangepicker()
        })
    </script>
@endpush
