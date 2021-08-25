@extends('admin/layout')
@section('page_title','Coupon');
@section('coupon_active_class','active')
@section('container')
<div class="row">
    <h1>Coupons</h1>
    <div class="col-md-12 mt-5">
        <a class="btn btn-success my-3" href="{{url('admin/coupon/manage_coupon')}}">Add Coupon</a>
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <div>
                <p class="text-success my-3">{{session('msg')}}</p>
            </div>
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    @foreach( $coupons as $coupon)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$coupon -> id}}</td>
                        <td>{{$coupon -> title}}</td>
                        <td>{{$coupon -> code}}</td>
                        <td>{{$coupon -> value}}</td>
                        <td><a href="{{url('admin/coupon/manage_coupon')}}/{{$coupon -> id}}" class="btn btn-primary">Edit</a>&nbsp;
                            @if($coupon -> status == 1)
                            <a href="{{url('admin/coupon/status/deactive')}}/{{$coupon -> id}}" class="btn btn-warning">Deactive</a>&nbsp;
                            @else
                            <a href="{{url('admin/coupon/status/active')}}/{{$coupon -> id}}" class="btn btn-success">Active</a>&nbsp;
                            @endif
                            <a href="coupon/delete/{{$coupon -> id}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection