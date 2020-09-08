@foreach ($products as $product)
<div class='col-md-3 list-item'>
    <div class="h-75">
        <img src="{{asset('/uploads/product/'.$product->image)}}" class="mw-100 list-item-image"  />
    </div>
    <h3 class="text-primary list-item-name">{{$product->name}}</h3>
    <p class="mb-0 ">$<span class="list-item-price">{{$product->price}}</span></p>
    <input type="number" class="w-25 form-control d-inline list-item-quantity" min="1" value="1"/>
    <input type="hidden" class="list-item-id" value="{{$product->id}}"/>
    <button type="button" class="btn btn-secondary list-item-add-to-cart-button" data-original-title="" title=""  >
        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
    </button>

</div>
@endforeach