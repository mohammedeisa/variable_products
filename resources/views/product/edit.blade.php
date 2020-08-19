@extends('main')

@section('content')
<div class="">

    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <!--<form method="post" action="{{ url('/product/edit/'.$product->id) }}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">-->
            {!! Form::model($product,['method' => 'POST', 'route' => ['product.edit',$product->id]]) !!}

            <div class="x_title">
                <h2>Edit <small>{{$product->name}}</small></h2>  

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
                    {!! Html::decode(Form::label('name', 'Name<span class="required">*</span>', ['class' => 'col-form-label col-md-2 col-sm-2 label-align'])) !!}

                    <div class="col-md-8 col-sm-8 ">
                        {!! Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => '','id'=>'name','required'=>"required"]) !!}
                        @if ($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>

                </div>
                <div class="item form-group">
                    {!! Html::decode(Form::label('category', 'Category<span class="required">*</span>', ['class' => 'col-form-label col-md-2 col-sm-2 label-align'])) !!}

                    <div class="col-md-8 col-sm-8 ">
                        @if(isset($product->category))
                        {!! Form::select('category', [$product->category->id=>$product->category->name], $product->category->id, ['class' => 'category-selector form-control','required'=>'required']) !!}
                        @else
                        {!! Form::select('category', [], [], ['class' => 'category-selector form-control','required'=>'required']) !!}
                        @endif
                        <input type="hidden" id="is_new_category" name="is_new_category"/>
                    </div>
                </div>
                @include('product.fields.description_field', ['item'=>$product,'value' => $product->description])
                @include('product.fields.variations_field', ['product'=>$product])
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button class="btn btn-primary" type="button">Cancel</button>
                        {!! Form::button('Cancel', ['class' => 'btn btn-primary']) !!}
                        {!! Form::reset('Reset', ['class' => 'btn btn-primary']) !!}
                        {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}

                    </div>
                </div>

            </div>
            <input type="hidden" name="id" value="{{$product->id}}"/>
            {{ csrf_field() }}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop