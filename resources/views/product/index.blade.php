@extends('main')

@section('content')
<div class="">

    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Products list <a href="{{url('/product/create')}}"><button type="button" class="btn btn-secondary">Add product</button></a></h2>                               
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


                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">Name </th>
                                <th class="column-title">Category</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)                                                        
                            <tr class="even pointer">
                                <td class="a-center ">
                                    <input type="checkbox" class="flat" name="table_records">
                                </td>
                                <td class=" ">{{ $product->name}}</td>
                                <td class=" ">{{ $product->category->name ?? ''}}</td>                               
                                <td class=" last">
                                    <a href="{{ url('/product/edit/'.$product->id) }}">Edit</a> | 
                                    <a href="{{ url('/product/delete/'.$product->id) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">{{$products->render()}}</div>

            </div>
        </div>
    </div>
</div>
@stop