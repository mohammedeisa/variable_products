@extends('main_frontend')
@section('topBar')
@stop

@section('content')

<div id="products_list">


    <div class="alert alert-success alert-dismissible success-message" style="display: none"  role="alert">
        the order has been created successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="row mb-5">
        <div class="page-title">
            <div class="col-md-2">
                <div class="category_sort">
                    <a href="#">Sort by category</a><a class="collapse-link "><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>

            <div class="col-md-8 d-flex justify-content-center">
                <div class="col-md-5 col-sm-5   form-group top_search">
                    <div class="input-group">
                        <input type="text" id="search_input" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="search_button" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class='col-md-2 d-flex justify-content-end cart-box'>
                <button type="button" class="btn btn-secondary">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='col-md-2'>
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="list-group-item">
                    <div class="sidebar-heading"><span class="glyphicon glyphicon-play" aria-hidden="true"></span>Categories</div>
                    <div class="list-group list-group-flush">
                        @foreach ($categories as $category)
                        <a href="#" class="list-group-item list-group-item-action bg-light text-primary">{{$category->name}}</a>   
                        @endforeach

                    </div>
                </div>
                <div class="list-group-item">

                    <div class="sidebar-heading"><span class="glyphicon glyphicon-play" aria-hidden="true"></span>Brand</div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action bg-light">Adidas</a>                 
                    </div>
                </div>
                <div class="list-group-item">

                    <div class="sidebar-heading">Price</div>
                    <div class="list-group list-group-flush">
                        <input type="text" class="js-range-slider" name="price_range" value=""
                               data-type="double"
                               data-min="0"
                               data-max="5000"
                               data-from="200"
                               data-to="500"
                               data-grid="true"
                               />                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-10'>
            <div class="container-fluid">
                <div id="products_list_container" class="row ">
                    @include('product.frontend.list_of_products_block')
                </div>
            </div>
        </div>
    </div>

    <!--The cart box popover content-->
    <div id="cart-box-content">
        <hr class="mt-2 mb-3"/>
        <div class="cart-box-content-items">
            The cart is empty
        </div>
        <hr class="mt-2 mb-3"/>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">Total:$<span class="cart-box-total">0</span></div>
        </div><div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button class="btn btn-primary" type="button">Review</button>
                <button class="btn btn-primary cart-box-submit" type="button">Submit</button>
            </div>
        </div>
    </div>
    <!--Template for the cart items in the cart box-->
    <div id="item-in-cart-box-template">
        <div class="row cart-box-item" p-id="">
            <div class='col-md-3'>
                <img  class="mw-100 cart-box-item-image" />
            </div>
            <div class="col-md-4">
                <h5 class="text-primary cart-box-item-name">Product name</h5>
                <p class="mb-0 cart-box-item-price">$800</p>
            </div>
            <div class="col-md-3">
                <input type="text" disabled="disabled" class="form-control cart-box-item-quantity"  min="1"/>
            </div>
            <input type="hidden" class="cart-box-item-id"/>
            <div class="col-md-2">
                <span class="glyphicon glyphicon-remove align-middle" aria-hidden="true"></span>
            </div>
        </div>
    </div>
</div>



@stop
