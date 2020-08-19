<div class="row" >
    <div class="col-md-12 col-sm-12 " >
        <div class="x_panel">
            <div class="x_title">
                <h2>Product Variations</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="item form-group row">
                    <label class="col-form-label col-md-2 col-sm-2 label-align" for="attributes">Select variations attributes<span class="required">*</span>
                    </label>

                    <div class="col-md-8 col-sm-8 ">
                        @if(isset($product))
                        {!! Form::select('attributes[]', $product->attributes->pluck('name','id')->all(), $product->attributes->pluck('id')->all(), ['class' => 'attribute-selector form-control', 'multiple' => 'multiple','required'=>'required']) !!}
                        @else
                        {!! Form::select('attributes[]', [], [], ['class' => 'attribute-selector form-control', 'multiple' => 'multiple','required'=>'required']) !!}
                        @endif
                    </div>
                </div>

                <div class="item form-group row">
                    <label class="col-form-label col-md-2 col-sm-2 label-align" for="attributes">Variations<span class="required">*</span>
                    </label>

                    <div class="item form-group col-md-8 col-sm-8">
                        <div id="product_variations" class="w-100 p-3" style="padding: 0!important">
                            @isset($product)
                            @foreach ($product->variations as $variation)
                            @include('product.fields.variation_block', ['variation'=>$variation,'variation_attributes' => $variation->attributes,'variation_block_index'=> $loop->iteration ])
                            @endforeach
                            @endisset
                            <input type="hidden" name="variations_count" id="variations_count" value="0"/>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-2"></div>
                    <div class="col-md-2 col-sm-2">                                                                                        
                        <div class="item form-group">
                            <button type="button" class="btn btn-primary disabled" id="add_variation">Add a variation</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

