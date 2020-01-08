@extends('admin.layouts.main')
@section('content-header')
    <section class="content-header">
        <h1>
            ORDERS MANAGEMENT
        </h1>
    </section>
@endsection
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title" style="font-size: 20px">Orders Table</h1>
            </div>
            <form action="{{route('Admin::order@index')}}" method="get">
            <div class="form-group m-form__group row align-items-center">
                <div class="col-md-3">
                    <div class="m-form__group">
                        <div class="m-form__label">
                            <label>
                                Mã đơn hàng:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <input type="text" class="form-control m-input" name="name"
                                   value="{{ Request::input('name') }}"
                                   data-col-index="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="m-form__group">
                        <div class="m-form__label">
                            <label>
                                Ngày đặt hàng:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <input type="text" class="form-control m-input" name="address"
                                   value="{{ Request::input('address') }}"
                                   data-col-index="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="m-form__group">
                        <div class="m-form__label">
                            <label>
                                Trạng thái:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <input type="text" class="form-control m-input" name="code"
                                   value="{{ Request::input('code') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="m-form__group">
                        <div class="m-form__label">
                            <label>
                                Khách hàng:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <input type="text" class="form-control m-input"
                                   name="phone_number"
                                   value="{{ Request::input('phone_number') }}">
                        </div>
                    </div>
                </div>
            </div>
            </form>
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
                        <th>Code</th>
                        <th>User</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Finish Day</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->code}}</td>
                            <td><a href="{{route('Admin::order@index')}}?user_id={{$order->user_id}}">{{$order->user_name}}</a></td>
                            <td>{{$order->discount}}</td>
                            <td>
                                <select name="status" id="{{$order->id}}">
                                    <option value="0" @if($order->status == 0) selected="selected" @endif>Pending</option>
                                    <option value="1" @if($order->status == 1) selected="selected" @endif>Success</option>
                                    <option value="2" @if($order->status == 2) selected="selected" @endif>Cancel</option>
                                </select>
{{--                                @if($order->status == 0)--}}
{{--                                    {{"Pending"}}--}}
{{--                                    @elseif($order->status == 1)--}}
{{--                                    {{"Success"}}--}}
{{--                                    @else--}}
{{--                                    {{"Cancel"}}--}}
{{--                                    @endif--}}
                            </td>
                            <td>{{$order->finish_day}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-{{$order->id}}">
                                    View Detail
                                </button>
                            </td>
                            <div class="modal fade" id="modal-{{$order->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Order Detail <b>{{$order->code}}</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($order->detail[0] as $item)
                                                <div style="border: 1px solid;margin-bottom: 5px">
                                                    <p>Product Name : {{$item->product_name}}</p>
                                                    <p>Quantity: {{$item->quantity}}</p>
                                                    <p>Price Unit: ${{$item->price}}</p>
                                                    <p>Cost : ${{$item->cost}}</p>
                                                </div>
                                            @endforeach
                                            <p><b>Total Cost:  ${{$order->detail[1]}}</b></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>User</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Finish Day</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
                {{ $orders->links() }}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("select").change(function () {
                var status = this.value;
                var order_id = this.id;
                var url = "{{ route('Admin::order@changeStatus',":id")}}";
                real_url = url.replace(':id', order_id);
                $.ajax({
                    url: real_url,
                    method: 'POST',
                    data: {
                        order_id: order_id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (msg) {
                        console.log(msg);
                    },
                    error: function (msg) {
                        console.log(msg);
                    }
                });
            });
        });

    </script>
@endpush
