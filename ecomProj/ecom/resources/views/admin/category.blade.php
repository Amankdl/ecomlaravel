@extends('admin/layout')
@section('page_title','Category');
@section('container')
@section('category_active_class','active')
<div class="row">
    <h1>Categories</h1>
    <div class="col-md-12 mt-5">
        <a class="btn btn-success my-3" href="{{url('admin/category/manage_category')}}">Add Category</a>
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
                    @foreach( $categories as $category)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$category -> id}}</td>
                        <td>{{$category -> category_name}}</td>
                        <td>{{$category -> slug}}</td>
                        <td>{{$category -> created_at}}</td>
                        <td><a href="{{url('admin/category/manage_category')}}/{{$category -> id}}" class="btn btn-primary">Edit</a>&nbsp;
                        @if($category -> status == 1)    
                        <a href="{{url('admin/category/status/deactive')}}/{{$category -> id}}" class="btn btn-warning">Deactive</a>&nbsp;
                        @else
                        <a href="{{url('admin/category/status/active')}}/{{$category -> id}}" class="btn btn-success">Active</a>&nbsp;
                        @endif
                        <a href="category/delete/{{$category -> id}}" class="btn btn-danger">Delete</a></td>
                    </tr>  
                    @endforeach                  
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection