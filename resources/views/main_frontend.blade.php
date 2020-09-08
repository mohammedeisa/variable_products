<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Variable products</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/frontend/variable_products.css') }}" rel="stylesheet">
        <link href="{{ url('admin-lte/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ url('/admin-lte/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">

        <link href="{{ url('/admin-lte/vendors/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet">
        <link href="{{ url('/admin-lte/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
        <link href="{{ url('/admin-lte/vendors/normalize-css/normalize.css') }}" rel="stylesheet">

        <!-- NProgress -->
        <!-- Custom styling plus plugins -->
        <link href="{{ url('/admin-lte/build/css/custom.min.css') }}" rel="stylesheet">
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">


                @section('topBar')
                <!-- top navigation -->
                <div class="top_nav"  style="margin-left: 0" >
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /top navigation -->
                @stop

                <!-- page content -->
                <div class="right_col" style="margin-left: 0" role="main">                    
                    @yield('content')
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ url('/admin-lte/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{ asset('/js/frontend/variable_products.js') }}"></script>
    <script>
var filter_products_by_price = '{{url("/products/filter")}}';
var search_products = '{{url("/products/search")}}';
var sort_by_category = '{{url("/products/sort_by_category")}}';
var place_an_order = '{{url("/orders/place_an_order/")}}';


    </script>
</body>               
</html>