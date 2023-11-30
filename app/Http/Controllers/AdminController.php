<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use PDF;

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

    public function view_order() {
        $order = Order::all();
        return view('admin.order', compact('order'));
    }

    public function delivered($id) {
        $order = Order::find($id);
        $order->delivery_status = "delivered";
        $order->payment_status = "paid";
        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id) {
        $order = Order::find($id);
        $pdf  = PDF::loadview('admin.pdf', compact('order'));

        return $pdf->download('order_details.pdf');
    }

    public function search_data(Request $request) {
        $search_Text = $request->search;
        $order = Order::where('name', 'LIKE', "%$search_Text%")->orWhere('phone', 'LIKE',
         "%$search_Text%")->orWhere('product_title', 'LIKE', "%$search_Text%")->get();

        return view('admin.order', compact('order'));
    }
}
