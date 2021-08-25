<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin/product')->with('products', Product::all());
    }

    public function manage_product(Request $request)
    {
        if ($request->id) {
            return view('admin/manage_product')->with('data', ['product' => Product::find($request->id), "categories" => DB::table('categories')->where('status', 1)->get(),  "colors" => DB::table('colors')->where('status', 1)->get(), "sizes" => DB::table('sizes')->where('status', 1)->get(), "product_attributes" => DB::table('product_attr')->where('product_id', $request->id)->get()]);
        }
        return view('admin/manage_product')->with('data', ["categories" => DB::table('categories')->where('status', 1)->get(), "colors" => DB::table('colors')->where('status', 1)->get(), "sizes" => DB::table('sizes')->where('status', 1)->get()]);
    }

    public function manage_product_process(Request $request)
    {
        $id = $request->id_for_edit; //if add mode than id will be -1.

        $request->validate([
            'product_name' => 'required',
            'slug' => 'required|unique:products,slug,' . $id,
            'category_id' => 'required | numeric',
        ]);

        if ($id > 0) { //edit mode
            $res = Product::find($id);
            $request->session()->flash('msg', 'Product updated sucessfully.');
        } else { //add mode
            $res = new Product;
            $res->status = 1;
            $request->session()->flash('msg', 'Product added sucessfully.');
        }

        $res->product_name = $request->product_name;
        $res->slug = $request->slug;
        $res->category_id = $request->category_id;
        $res->slug = $request->slug;
        $res->brand = $request->brand;
        $res->model = $request->model;
        $res->short_desc = $request->short_desc;
        $res->desc = $request->desc;
        $res->keywords = $request->keywords;
        $res->technical_specifications = $request->technical_specifications;
        $res->uses = $request->uses;
        $res->warranty = $request->warranty;
        $res->save();
        $pid = $res->id;

        // Product Attribute work Start from here
        $sku_attr = $request->sku;
        $mrp_attr = $request->mrp;
        $price_attr = $request->price;
        $qty_attr = $request->qty;
        $size_id_attr = $request->size;
        $color_id_attr = $request->color;

        $product_attr_array['product_id'] = $pid;
        foreach ($sku_attr as $key => $value) {
            $product_attr_array['sku'] = $sku_attr[$key];
            $product_attr_array['mrp'] = $mrp_attr[$key];
            $product_attr_array['price'] = $price_attr[$key];
            $product_attr_array['qty'] = $qty_attr[$key];
            $product_attr_array['size_id'] = $size_id_attr[$key];
            $product_attr_array['color_id'] = $color_id_attr[$key];
            if ($id > 0) {
                DB::table('product_attr')->where('sku',$pid)->update($product_attr_array);
            }else{
                DB::table('product_attr')->insert($product_attr_array);
            }
        }
        // Product Attribute work Ends here
        return redirect('admin/product');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Product::destroy([$id]);
        $request->session()->flash('msg', 'Product deleted sucessfully.');
        return redirect('admin/product');
    }

    public function update_status(Request $request, $status, $id)
    {
        $res = Product::find($id);
        $res->status = $status ==  "active" ? 1 : 0;
        $res->save();
        $request->session()->flash('msg', 'Status updated sucessfully.');
        return redirect('admin/product');
    }
}
