@extends('admin/layout')
@section('page_title','Color');
@section('color_active_class','active')
@section('container')
<div class="row">
    <h1>Colors</h1>
    <div class="col-md-12 mt-5">
        <a class="btn btn-success my-3" href="{{url('admin/color/manage_color')}}">Add Color</a>
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
                        <th>Color</th>
                        <th>Added on</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    @foreach( $colors as $color)
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$color -> id}}</td>
                        <td>{{$color -> color}}</td>
                        <td>{{$color -> created_at}}</td>
                        <td><a href="{{url('admin/color/manage_color')}}/{{$color -> id}}" class="btn btn-primary">Edit</a>&nbsp;
                        @if($color -> status == 1)    
                        <a href="{{url('admin/color/status/deactive')}}/{{$color -> id}}" class="btn btn-warning">Deactive</a>&nbsp;
                        @else
                        <a href="{{url('admin/color/status/active')}}/{{$color -> id}}" class="btn btn-success">Active</a>&nbsp;
                        @endif
                        <a href="color/delete/{{$color -> id}}" class="btn btn-danger">Delete</a></td>
                    </tr>  
                    @endforeach                  
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection