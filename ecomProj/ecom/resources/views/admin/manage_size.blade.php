@extends('admin/layout')
@section('page_title','Manage Size');
@section('size_active_class','active')
@section('container')
<div class="row">
    <div class="col-lg-12">
    <a class="btn btn-success my-3" href="{{url('admin/size')}}">Back</a>
        <div class="card">
            <div class="card-body">                
                <form action="{{route('size.insert')}}" method="post" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id_for_edit" <?php echo isset($size) ? "value='$size[id]'" : 'value=-1' ?>>
                    <div class="form-group">
                        <label for="size" class="control-label mb-1">Size Name</label>
                        <input id="size" name="size" <?php echo isset($size) ? "value='$size[size]'" : '' ?> type="text" class="form-control" required>
                    </div>
                    @error('size')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror                    
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit                                                        
                        </button>
                    </div>
                </form>
                <div>
                    <p>{{session('msg')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection