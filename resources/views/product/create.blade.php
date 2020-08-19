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

            <form method="post" action="{{ route('product.store') }}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

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
