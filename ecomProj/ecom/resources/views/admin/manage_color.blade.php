@extends('admin/layout')
@section('page_title','Manage Color');
@section('color_active_class','active')
@section('container')

<div class="row">
    <div class="col-lg-12">
    <a class="btn btn-success my-3" href="{{url('admin/color')}}">Back</a>
        <div class="card">
            <div class="card-body">                
                <form action="{{route('color.insert')}}" method="post" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id_for_edit" <?php echo isset($color) ? "value='$color[id]'" : 'value=-1' ?>>
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Color Name</label>
                        <input id="color" name="color" <?php echo isset($color) ? "value='$color[color]'" : '' ?> type="text" class="form-control" required>
                    </div>
                    @error('color')
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