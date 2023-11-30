<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF order</title>
</head>
<body>
    <h1>Order Details</h1>
    Customer name: <h3>{{$order->name}}</h3>
    Customer email: <h3>{{$order->email}}</h3>
    Customer Phone Number<h3>{{$order->phone}}</h3>
    Customer Address: <h3>{{$order->address}}</h3>
    Product title: <h3>{{$order->product_title}}</h3>
    Quantity Buy: <h3>{{$order->quantity}}</h3>
    Total Paid: <h3>{{$order->price}}</h3>
    Payment Status: <h3>{{$order->payment_status}}</h3>
    Delivery Status: <h3>{{$order->delivery_status}}</h3>
    <img sc="/product/{{$order->image}}"alt="">
</body>
</html>