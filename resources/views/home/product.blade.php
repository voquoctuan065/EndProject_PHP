<section class="product_section layout_padding" id="product">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">
               @foreach($product as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details', $product->id)}}" class="option1">
                           Product Details
                           </a>
                           <form action="{{url('add_cart', $product->id)}}" method="post">
                              @csrf
                              <input type="number" name="quantity" value="1" style="width: 165px; height: 30px; margin-top: 20px" min="1" max="10">
                              <br>
                              <button type="submit" class="text-center option2" 
                                 style="width: 165px; padding: 8px 15px; border-radius: 30px;">
                                 Add to cart
                              </button>
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="/product/{{$product->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product->title}}
                        </h5>
                        
                        <h6>
                           {{$product->price}}
                        </h6>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </section>