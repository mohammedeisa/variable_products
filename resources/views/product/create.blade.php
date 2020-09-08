@extends('main')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Add attribute</h3>
        </div>

    </div>
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">                                

            <form method="post" action="{{ route('product.store') }}" id="demo-form2" data-parsley-validate="" class="dropzone form-horizontal form-label-left" novalidate="" enctype="multipart/form-data">

                <div class="x_title">
                    <h2>General</h2>  

                    <div class="clearfix"></div>
                </div>
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                    {!! Session::get('message') !!} 
                </p>
                @endif
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
                @endforeach
                <div class="x_content">
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-2 label-align" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 ">
                            <input type="text" id="name" name="name" value="{{$product->name ?? ''}}" required="required" class="form-control " >
                            @if ($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-2 label-align" for="category">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 ">
                            <select class="category-selector form-control" name="category">
                            </select>
                            <input type="hidden" id="is_new_category" name="is_new_category"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <!-- image-preview-filename input [CUT FROM HERE]-->
                        <label class="col-form-label col-md-2 col-sm-2 label-align" for="product_image">Product image<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 ">
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                <span class="input-group-btn">
                                    <!-- image-preview-clear button -->
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                    </button>
                                    <button type="button" class="btn btn-default" id="toggle_popover" style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> Show/Hide preview
                                    </button>
                                    <!-- image-preview-input -->
                                    <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">Browse</span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="product_image"/> <!-- rename it -->
                                    </div>
                                </span>
                            </div><!-- /input-group image-preview [TO HERE]--> 
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-2 label-align" for="price">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 ">
                            <input type="text" id="name" name="price" value="{{$product->price ?? ''}}" required="required" class="form-control " >
                            @if ($errors->has('price'))
                            <div class="text-danger">
                                {{ $errors->first('price') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @include('product.fields.description_field')
                    @include('product.fields.variations_field')

                    <div class="item form-group">
                        <div class="col-md-8 col-sm-8 ">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$product->id ?? ''}}"/>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@stop

