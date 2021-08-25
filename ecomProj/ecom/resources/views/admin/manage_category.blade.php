@extends('admin/layout')
@section('page_title','Manage Category');
@section('category_active_class','active')
@section('container')
<div class="row">
    <div class="col-lg-12">
    <a class="btn btn-success my-3" href="{{url('admin/category')}}">Back</a>
        <div class="card">
            <div class="card-body">                
                <form action="{{route('category.insert')}}" method="post" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id_for_edit" <?php echo isset($category) ? "value='$category[id]'" : 'value=-1' ?>>
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input id="category_name" name="category_name" <?php echo isset($category) ? "value='$category[category_name]'" : '' ?> type="text" class="form-control" required>
                    </div>
                    @error('category_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="slug" class="control-label mb-1">Slug</label>
                        <input id="slug" name="slug" <?php echo isset($category) ? "value='$category[slug]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('slug')
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