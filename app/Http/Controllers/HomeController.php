<?php

namespace App\Http\Controllers;

use Stripe;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{

    public function redirect()
    {
        $user_type = Auth::user()->user_type;
        if ($user_type == 1) {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();

            $order = Order::all();
            $total_revenue = 0;
            foreach($order as $order) {
                $total_revenue += $order->price;
            }

            $total_delivered = Order::where('delivery_status', '=', 'delivered')->get()->count();
            $order_processing = Order::where('delivery_status', '=', 'processing')->get()->count();
            return view('admin.home', 
            compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'order_processing'));
        }
        else {
            $product = Product::all();
            return view('home.userpage', compact('product'));
        }
    }

    public function index()
    {
        $product = Product::all();
        return view('home.userpage', compact('product'));
    }

    public function product_details($id) {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id) {
        if(Auth::id()) {
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone_number;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->product_title = $product->title;

            if($product->discount != null) {
                $cart->price = $product->discount*$request->quantity;
            } else {
                $cart->price = $product->price*$request->quantity;
            }

            $cart->image = $product->image;
            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function show_cart() {
        if(Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.show_cart', compact('cart'));    
        }
        else {
            return redirect('login');
        }
        
    }

    public function remove_cart($id) {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back();
    }

    public function cash_order() {
        $user = Auth::user();
        $user_id = $user->id;

        $data = Cart::where('user_id' , '=', $user_id)->get();

        foreach($data as $data) {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message', 'We have received your order. We will connect with you soon... !');
    }

    public function stripe($total_price) {
        return view('home.stripe', compact('total_price'));
    }

    public function stripePost(Request $request, $total_price)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" =>  $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
      

        $user = Auth::user();
        $user_id = $user->id;

        $data = Cart::where('user_id' , '=', $user_id)->get();

        foreach($data as $data) {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
              
        return redirect('show_cart')->with('message', 'Payment successful!');
    }

    public function show_order() {
        if(Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;
            $order = Order::where('user_id', '=', $user_id)->get();
            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }  
    }

    public function cancel_order($id) {
        $order = Order::find($id);
        $order->delivery_status = 'You canceled the order';

        $order->save();
        return redirect()->back();
    }

    public function product_search(Request $request) {
        $search_txt = $request->search;
        $product = Product::where('title', 'LIKE', '%'.$search_txt.'%')->orWhere('category',
         'LIKE', '%'.$search_txt.'%')->get();

        return view('home.userpage', compact('product'));
    }
}

