@extends('admin/layout')
@section('page_title','Manage Coupon');
@section('coupon_active_class','active')
@section('container')
<div class="row">
    <div class="col-lg-12">
    <a class="btn btn-success my-3" href="{{url('admin/coupon')}}">Back</a>
        <div class="card">
            <div class="card-body">                
                <form action="{{route('coupon.insert')}}" method="post" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id_for_edit" <?php echo isset($coupon) ? "value='$coupon[id]'" : 'value=-1' ?>>
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Coupon Name</label>
                        <input id="title" name="title" <?php echo isset($coupon) ? "value='$coupon[title]'" : '' ?> type="text" class="form-control" required>
                    </div>
                    @error('title')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="code" class="control-label mb-1">Code</label>
                        <input id="code" name="code" <?php echo isset($coupon) ? "value='$coupon[code]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('code')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="value" class="control-label mb-1">Value</label>
                        <input id="value" name="value" <?php echo isset($coupon) ? "value='$coupon[value]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('value')
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