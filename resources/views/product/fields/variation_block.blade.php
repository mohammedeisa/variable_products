<div class="x_panel col-md-12 variation_block">
    <div class="spinner-border ajax-loading-icon" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <input type="hidden" name="product[old_variations][{{$variation->id }}][id]" class="variation_id" value="{{$variation->id}}"/>
    <div class="x_title">
        <h2>Variation#{{$variation_block_index}}</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                                                        
        </ul>
        <div class="clearfix"></div>
        <input type="hidden" class="variation-update-checker" name="product[old_variations][{{$variation->id }}][updated]" value="" />
    </div>
    <div class="x_content">
        <div class="item form-group">
            <div class="col-md-2 text-white p-3 mb-2 text-white p-3 mb-2 bg-secondary">
                <label class="float-right">Attribute name</label>
            </div>
            <div class="col-md-8 text-white p-3 mb-2 text-white p-3 mb-2 bg-secondary">
                Attribute value
            </div>
        </div>

        @foreach ($variation_attributes as $variation_attribute)
        <div class="item form-group">
            <label class="col-form-label col-md-2 col-sm-2 label-align" for="#">{{$variation_attribute->attribute->name}}<span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
                <input type="text" id="name" name="product[old_variations][{{$variation->id }}][attributes][{{ $variation_attribute->attribute->id }}][value]" value="{{$variation_attribute->value}}" required="required" class="form-control " >
                <input type="hidden" name="product[old_variations][{{$variation->id }}][attributes][{{ $variation_attribute->attribute->id }}][attribute_id]" value="{{ $variation_attribute->attribute->id }}" >                
                <div class="text-danger">
                </div>
            </div>
        </div> 
        @endforeach

        <hr>
        <div class="item form-group">
            <label class="col-form-label col-md-2 col-sm-2 label-align" for="attributes">Quantity<span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
                <input type="text" id="name" name="product[old_variations][{{$variation->id }}][quantity]" value="{{$variation->quantity ?? ''}}" required="required" class="form-control " >
                <div class="text-danger">
                </div>
            </div>
        </div> 

        <div class="item form-group">
            <label class="col-form-label col-md-2 col-sm-2 label-align" for="attributes">Pice<span class="required">*</span>
            </label>
            <div class="col-md-8 col-sm-8 ">
                <input type="text" id="name" name="product[old_variations][{{$variation->id }}][price]" value="{{$variation->price ?? ''}}" required="required" class="form-control " >
                <div class="text-danger">
                </div>
            </div>
        </div> 

        <div class="item form-group">
            <div class="col-md-10 col-sm-10">
                <button class="btn btn-danger delete-variation pull-right" type="button">Delete</button>
            </div>
        </div>
    </div>
</div>