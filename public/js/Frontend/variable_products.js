
$(document).ready(function () {
//    Init price range field and handle filter by it////////////////////////
    $(".js-range-slider").ionRangeSlider({
        onFinish: function (data) {
            $(".js-range-slider").attr('price_from', data.from);
            $(".js-range-slider").attr('price_to', data.to);
            $.ajax({
                url: filter_products_by_price,
                dataType: 'json',
                method: "GET",
                data: {'price_from': data.from, 'price_to': data.to},
                success: function (data, status, xhr) {
                    $('#products_list_container').html(data.html);
                    console.log(data.html);
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        },
    });
//Search////////////////////////
    $('#search_button').click(function () {
        $.ajax({
            url: search_products,
            dataType: 'json',
            method: "GET",
            data: {'query': $('#search_input').val()},
            success: function (data, status, xhr) {
                $('#products_list_container').html(data.html);
                console.log(data.html);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    });
//Add and update Cart box////////////////////////
    $(document).on('click', '.list-item-add-to-cart-button', function () {
        const name = $(this).closest('.list-item').find('.list-item-name').html(), price = $(this).closest('.list-item').find('.list-item-price').html(), quantity = $(this).closest('.list-item').find('.list-item-quantity').val(), id = $(this).closest('.list-item').find('.list-item-id').val(), imageSrc = $(this).closest('.list-item').find('.list-item-image').attr('src');
        var anItemHasUpdated = false;
        const existinPtoductsIds = $('#cart-box-content .cart-box-item-id');
        jQuery.each(existinPtoductsIds, function (i, val) {
            if (id === $(val).val()) {
                UpdateItemInCartBox(id, quantity);
                anItemHasUpdated = true;
            }
        });
        if (!anItemHasUpdated) {
            addItemToCartBox(name, price, quantity, id, imageSrc);
        }
        calculateAndUpdateCartBoxTotal();
        initializePopover();
    });
    function addItemToCartBox(name, price, quantity, id, imageSrc) {
        var cartItemsCount = $('#cart-box-content .cart-box-item').length;
        $('#item-in-cart-box-template .cart-box-item-name').text(name);
        $('#item-in-cart-box-template .cart-box-item-image').attr('src', imageSrc);
        $('#item-in-cart-box-template .cart-box-item-price').html(price);
        $('#item-in-cart-box-template .cart-box-item-quantity').attr('value', quantity);
        $('#item-in-cart-box-template .cart-box-item-id').val(id);
        $('#item-in-cart-box-template>div').attr('p-id', id);
        if (cartItemsCount === 0)
        {
            $('#cart-box-content .cart-box-content-items').html($('#item-in-cart-box-template').html());
        } else {
            $('#cart-box-content .cart-box-content-items').append($('#item-in-cart-box-template').html());
        }
    }
    function UpdateItemInCartBox(id, quantity) {
        const oldQuantity = $("#cart-box-content .cart-box-item[p-id='" + id + "']").find(".cart-box-item-quantity").val();
        const newQuantity = parseInt(oldQuantity) + parseInt(quantity);
        $("#cart-box-content .cart-box-item[p-id='" + id + "']").find(".cart-box-item-quantity").attr('value', newQuantity);
    }

    function calculateAndUpdateCartBoxTotal() {
        total = 0;
        const cartItems = $('#cart-box-content .cart-box-item');
        jQuery.each(cartItems, function (i, val) {
            const itemPrice = $(val).find('.cart-box-item-price').html();
            const itemQuantity = $(val).find('.cart-box-item-quantity').val();
            total += (parseInt(itemPrice) * parseInt(itemQuantity));
        });
        $('#cart-box-content .cart-box-total').html(total);
    }
//Remove
// item from cart box////////////////////////
    $(document).on('click', '.cart-box-item .glyphicon-remove', function () {
        const productId = $(this).closest('.cart-box-item').attr('p-id');
        $(this).closest('.cart-box-item').remove();
        $('#cart-box-content .cart-box-item[p-id="' + productId + '"]').remove();
        calculateAndUpdateCartBoxTotal();
        initializePopover();
    });
//Initiate cart box popover////////////////////////

    $('.cart-box button').popover({
        container: "body",
        toggle: "popover",
        placement: "bottom",
        content: "The cart is empty",
        html: true,
        sanitize: false,
        trigger: 'click'
    }
    );
    $('.cart-box button').attr('data-content', $('#cart-box-content').html());
//    $('.cart-box button').popover('show');
    $('.cart-box button').on('show.bs.popover', function () {
        $(this).removeClass('closed');
        $(this).addClass('opened');
    })
    $('.cart-box button').on('hide.bs.popover', function () {
        $(this).removeClass('opened');
        $(this).addClass('closed');
    })

    function initializePopover() {
        $('.cart-box button').attr('data-content', $('#cart-box-content').html());
        $('.cart-box button').popover('show');
    }

//Sort by category////////////////////////

    $('.category_sort').click(function () {
        var orderLink = $(this);
        var sortingDirection = ($('.category_sort .fa-chevron-up').length > 0) ? 'asc' : 'desc';
        $.ajax({
            url: sort_by_category,
            dataType: 'json',
            method: "GET",
            data: {'order': sortingDirection},
            success: function (data, status, xhr) {
                $('#products_list_container').html(data.html);
                if (sortingDirection === 'asc') {
                    $('.category_sort .fa-chevron-up').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                } else {
                    $('.category_sort .fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                }
                console.log(data.html);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    });
//Place an order////////////////////////

    $(document).on('click', '.cart-box-submit', function () {
        orderData = {}, orderData.items = [];
        orderData.total = $('.popover-body .cart-box-total').text();
        cartItems = $('#cart-box-content .cart-box-item');
        jQuery.each(cartItems, function (i, val) {
            const itemPrice = $(val).find('.cart-box-item-price').html(), itemQuantity = $(val).find('.cart-box-item-quantity').val(), subtotal = (parseInt(itemPrice) * parseInt(itemQuantity));
            var row = {};
            row.product_id = $(this).attr('p-id'), row.price = itemPrice, row.quantity = itemQuantity, row.subtotal = subtotal;
            orderData.items.push(row);
        });
        console.log(orderData);
        $.ajax({
            url: place_an_order,
            dataType: 'json',
            method: "POST",
            data: {'order_data': (orderData)},
            success: function (data, status, xhr) {
                $('.success-message').show();
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    });

});