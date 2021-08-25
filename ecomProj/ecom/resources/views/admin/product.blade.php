@extends('admin/layout')
@section('page_title','Product');
@section('product_active_class','active')
@section('container')
<div class="row">
    <h1>Products</h1>
    <div class="col-md-12 mt-5">
        <a class="btn btn-success my-3" href="{{url('admin/product/manage_product')}}">Add Product</a>
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
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Added on</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    @foreach( $products as $product)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$product -> id}}</td>
                        <td>{{$product -> product_name}}</td>
                        <td>{{$product -> slug}}</td>
                        <td>{{$product -> created_at}}</td>
                        <td><a href="{{url('admin/product/manage_product')}}/{{$product -> id}}" class="btn btn-primary">Edit</a>&nbsp;
                        @if($product -> status == 1)    
                        <a href="{{url('admin/product/status/deactive')}}/{{$product -> id}}" class="btn btn-warning">Deactive</a>&nbsp;
                        @else
                        <a href="{{url('admin/product/status/active')}}/{{$product -> id}}" class="btn btn-success">Active</a>&nbsp;
                        @endif
                        <a href="product/delete/{{$product -> id}}" class="btn btn-danger">Delete</a></td>
                    </tr>  
                    @endforeach                  
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection