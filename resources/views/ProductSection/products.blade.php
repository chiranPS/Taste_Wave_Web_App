
@foreach($data as $product)
<div class="col-12 col-sm-6 col-md-4 col-lg-3 all {{ strtolower($product->food_category) }}">
<div class="product-item {{ strtolower($product->food_category) }}">
    <div style="max-width: 300px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #f9fafb; font-family: Arial, sans-serif;">
    <div style="position: relative; margin-bottom: 0;"> <!-- Adjusted margin-bottom to 0 -->
    <img src="{{ url('storage/' . $product->image) }}" alt="{{ $product->product_name }}" style="width: 100%; height: 200px; border-radius: 12px;"/>
    </div>
    <div style="background-color: #1a1a2e; color: #ffffff; text-align: left; border-radius: 12px; padding: 12px;">
        <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 8px;">
        {{$product->product_name}}
        </h2>
        <p style="font-size: 14px; color: #cccccc; margin-bottom: 12px;">
        {{$product->description}}
        </p>
        <div style="display: flex; justify-content: space-between; align-items: center;">
        <span style="font-size: 18px; font-weight: bold;">LKR {{$product->product_price}}</span>

        <form action="{{url('addcart',$product->id)}}" method="POST">
        @csrf
            <input type="number" value="1" min="1" class="form-control" style="width:50px" name="quantity">
            <br>
            <button
                type="submit"
                style="
                background-color: #facc15;
                color: black;
                width:50px;
                border: none;
                border-radius: 20%;
                padding: 10px;
                cursor: pointer;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                "
                onmouseover="this.style.backgroundColor='#fbbf24';"
                onmouseout="this.style.backgroundColor='#facc15';"
            >
            <!-- <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                style="width: 20px; height: 20px;"
                >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6m10.5-6l1.5 6m-14 0h15a1 1 0 001-1v-1H3v1a1 1 0 001 1z"
                />
            </svg> -->
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            </button>
        </form>
        </div>
    </div>
    </div>
</div>
</div>
@endforeach
