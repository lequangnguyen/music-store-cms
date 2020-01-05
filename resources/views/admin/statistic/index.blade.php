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
                <form action="{{route('Admin::statistic@getStatistic')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group m-form__group row align-items-center">
                        <div class="col-md-3">
                            <label>Choose date range:</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date-range" class="form-control pull-right" id="reservation">
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
                @if(session('Notice'))
                    <div class='alert alert-success'>
                        {{session('Notice')}}
                    </div>

                @endif
               <div class="result">

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
