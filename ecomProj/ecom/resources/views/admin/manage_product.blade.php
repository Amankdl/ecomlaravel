@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_active_class','active')
@section('container')
<?php
$product_attributes = [""=>""]; //for showing product attributes box atleast once at the time of add.
if (isset($data['product'])) {
    $product = $data['product']; 
    $product_attributes = json_decode($data['product_attributes'], true); //Override above $product_attributes in case of edit.
}
$categories = json_decode($data['categories'], true);
$colors = json_decode($data['colors'], true);
$sizes = json_decode($data['sizes'], true);
?>
<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-success my-3" href="{{url('admin/product')}}">Back</a>
        <form action="{{route('product.insert')}}" method="post">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="id_for_edit" <?php echo isset($product) ? "value='$product[id]'" : 'value=-1' ?>>

                    <div class="form-group">
                        <label for="product_name" class="control-label mb-1">Product Name</label>
                        <input id="product_name" name="product_name" <?php echo isset($product) ? "value='$product[product_name]'" : '' ?> type="text" class="form-control" required>
                    </div>
                    @error('product_name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="slug" class="control-label mb-1">Slug</label>
                        <input id="slug" name="slug" <?php echo isset($product) ? "value='$product[slug]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('slug')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="category_id" class="control-label mb-1">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                            @if(isset($product) && $product['category_id'] == $category['id'])
                            <option selected value="{{$category['id']}}">{{$category['category_name']}}</option>
                            @else
                            <option value="{{$category['id']}}">{{$category['category_name']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand" class="control-label mb-1">Brand</label>
                        <input id="brand" name="brand" <?php echo isset($product) ? "value='$product[brand]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('brand')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="model" class="control-label mb-1">Model</label>
                        <input id="model" name="model" <?php echo isset($product) ? "value='$product[model]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('model')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="short_desc" class="control-label mb-1">Short Description</label>
                        <input id="short_desc" name="short_desc" <?php echo isset($product) ? "value='$product[short_desc]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('short_desc')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="desc" class="control-label mb-1">Description</label>
                        <input id="desc" name="desc" <?php echo isset($product) ? "value='$product[desc]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('desc')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="keywords" class="control-label mb-1">Keywords</label>
                        <input id="keywords" name="keywords" <?php echo isset($product) ? "value='$product[keywords]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('keywords')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="technical_specifications" class="control-label mb-1">Technical Specifications</label>
                        <input id="technical_specifications" name="technical_specifications" <?php echo isset($product) ? "value='$product[technical_specifications]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('technical_specifications')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="uses" class="control-label mb-1">Uses</label>
                        <input id="uses" name="uses" <?php echo isset($product) ? "value='$product[uses]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('uses')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror<div class="form-group">
                        <label for="warranty" class="control-label mb-1">Warranty</label>
                        <input id="warranty" name="warranty" <?php echo isset($product) ? "value='$product[warranty]'" : '' ?> type="text" class="form-control" aria-required="true" required>
                    </div>
                    @error('warranty')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror

                </div>
            </div>
            <div class="attr_box">
            <h3 class="mb-3">Product Attributes</h3>
            @foreach($product_attributes as $attribute)
            <div class="card">
                <div class="card-body row">
                    <div class="form-group col-md-2">
                        <label for="sku" class="control-label mb-1">SKU</label>
                        <input id="sku" name="sku[]" <?php echo isset($product) ? "value='$attribute[sku]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="mrp" class="control-label mb-1">MRP</label>
                        <input id="mrp" name="mrp[]" <?php echo isset($product) ? "value='$attribute[mrp]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="price" class="control-label mb-1">Price</label>
                        <input id="price" name="price[]" <?php echo isset($product) ? "value='$attribute[price]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="color" class="control-label mb-1">Color</label>
                        <select name="color[]" id="color" class="form-control">
                            <option selected>Select Color</option>
                            @foreach($colors as $color)
                            @if(isset($product) && $attribute['color_id'] == $color['id'])
                            <option selected value="{{$color['id']}}">{{$color['color']}}</option>
                            @else
                            <option value="{{$color['id']}}">{{$color['color']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="size" class="control-label mb-1">Size</label>
                        <select name="size[]" id="size" class="form-control">
                            <option selected>Select Size</option>
                            @foreach($sizes as $size)
                            @if(isset($product) && $attribute['size_id'] == $size['id'])
                            <option selected value="{{$size['id']}}">{{$size['size']}}</option>
                            @else
                            <option value="{{$size['id']}}">{{$size['size']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="qty" class="control-label mb-1">Qty</label>
                        <input id="qty" name="qty[]" <?php echo isset($product) ? "value='$attribute[qty]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                        <input id="attr_image" name="attr_image[]" <?php echo isset($product) ? "value='$product[product_name]'" : '' ?> type="file" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                    <label for="attr_image" class="control-label mb-1"></label>
                    <button type="button" class="btn btn-success btn-lg form-control" onclick="addAttributeBox()">
                    <i class="fas fa-plus-square"></i>&nbsp; Add</button>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
            <div>
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    Submit
                </button>
            </div>
            <div>
                <p>{{session('msg')}}</p>
            </div>
        </form>

    </div>
</div>
<script>
        var count = 1;
        function addAttributeBox(){
            var tpl = `<div class="card" id="product_attr_${count}">
                <div class="card-body row">

                    <div class="form-group col-md-2">
                        <label for="sku" class="control-label mb-1">SKU</label>
                        <input id="sku" name="sku[]" <?php echo isset($product) ? "value='$product[product_name]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="mrp" class="control-label mb-1">MRP</label>
                        <input id="mrp" name="mrp[]" <?php echo isset($product) ? "value='$product[product_name]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="price" class="control-label mb-1">Price</label>
                        <input id="price" name="price[]" <?php echo isset($product) ? "value='$product[product_name]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="size" class="control-label mb-1">Size</label>
                        <select name="size[]" id="size" class="form-control">
                            <option selected>Select Size</option>
                            @foreach($sizes as $size)
                            @if(isset($product) && $product['category_id'] == $category['id'])
                            <option selected value="{{$size['id']}}">{{$size['size']}}</option>
                            @else
                            <option value="{{$size['id']}}">{{$size['size']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="size" class="control-label mb-1">Color</label>
                        <select name="color[]" id="color" class="form-control">
                            <option selected>Select Color</option>
                            @foreach($colors as $color)
                            @if(isset($product) && $product['category_id'] == $category['id'])
                            <option selected value="{{$color['id']}}">{{$color['color']}}</option>
                            @else
                            <option value="{{$color['id']}}">{{$color['color']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="qty" class="control-label mb-1">Qty</label>
                        <input id="qty" name="qty[]" <?php echo isset($product) ? "value='$product[product_name]'" : '' ?> type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                        <input id="attr_image" name="attr_image[]" <?php echo isset($product) ? "value='$product[product_name]'" : '' ?> type="file" class="form-control" required>
                    </div>

                    <div class="form-group col-md-3">
                    <label for="attr_image" class="control-label mb-1"></label>
                    <button type="button" class="btn btn-danger btn-lg form-control" onclick="removeAttributeBox('product_attr_${count}')">
                    <i class="fas fa-minus"></i>&nbsp; Remove</button>
                    </div>
                </div>
            </div>`;

            $(".attr_box").append(tpl);
            ++count;
        }

        function removeAttributeBox(id){
            $(`#${id}`).remove();
        }
</script>
@endsection