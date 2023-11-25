<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_category() {
        $data= category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request) {
        $data = new category;
        $data->category_name = $request->categoryName;

        $data->save();

        return redirect()->back()->with('message', 'Category added successfully!');
    }

    public function delete_category($id) {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category deleted successfully!');
    }

    public function view_product() {
        $category= category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request) {
        $product = new product;
        $product->title = $request->productTitle;
        $product->description = $request->productDescription;
        $product->category = $request->productOfCategory;
        $product->quantity = $request->quantity;
        $product->price = $request->productPrice;
        $product->discount = $request->discount;

        $imageUpload = $request->file('productImage');
        $image = time().'.'.$imageUpload->getClientOriginalExtension();
        $imageUpload->move('product', $image);

        $product->image = $image;

        $product->save();
        return redirect()->back()->with('message', 'Product added successfully!');
    }

    public function show_product() {
        $product = product::all();
        return view('admin.show_product', compact('product'));
    }

    public function delete_product($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted successfully!');
    }

    public function update_product($id) {
        $product = Product::find($id);
        $category= category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    public function update_product_confirm($id, Request $request) {
        $product = product::find($id);
        $product->title = $request->productTitle;
        $product->description = $request->productDescription;
        $product->category = $request->productOfCategory;
        $product->quantity = $request->quantity;
        $product->price = $request->productPrice;
        $product->discount = $request->discount;

        $imageUpload = $request->file('productImage');
        $image = time().'.'.$imageUpload->getClientOriginalExtension();
        $imageUpload->move('product', $image);

        $product->image = $image;

        $product->save();
        return redirect('show_product')->with('message', 'Product updated succesfully!');
    }
}
