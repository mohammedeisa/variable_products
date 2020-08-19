
$(document).ready(function () {

    $('#editor-one').change(function () {
        $('#descr').val($(this).html());
    });
    $('.category-selector').select2({
        placeholder: "Select a category",
        allowClear: true,
        debug: true,
        ajax: {

            url: category_search_url,
            dataType: 'json',
            type: "GET",
            data: function (params) {
                var query = {
                    term: params.term,
                    page: params.page || 1
                };
                return query;
            },
            processResults: function (data, page) {
                return {
                    results: $.map(data, function (obj) {
                        return {id: obj.id, text: obj.name};
                    })
                };
            }
        },
        tags: true,
        createTag: function (params) {
            $('#is_new_category').val('yes');
            return {
                id: params.term,
                text: params.term,
                newOption: true
            }
        }
    });
    $('.attribute-selector').select2({
        placeholder: "Select attributes",
        allowClear: true,
        debug: true,
        ajax: {
            url: attribute_search_url,
            dataType: 'json',
            type: "GET",
            data: function (params) {
                var query = {
                    term: params.term,
                    category_id: $('.category-selector').val(),
                    page: params.page || 1
                };
                return query;
            },
            processResults: function (data, page) {
                return {
                    results: $.map(data, function (obj) {
                        return {id: obj.id, text: obj.name};
                    })
                };
            }

        },
//        tags: true
//        createTag: function (params) {
//            $('#is_new_attribute').val('yes');
//            return {
//                id: params.term,
//                text: params.term,
//                newOption: true
//            }
//        }

    }).change(function () {
        enableOrDisableAddingVariationsButton();
    });


////////////////////////////////////////////////////////////////////
    var enableOrDisableAddingVariationsButton = function () {
        if ($('.attribute-selector').val().length > 0) {
            $("#add_variation").removeClass('disabled');
        } else {
            if (!$("#add_variation").hasClass('disabled')) {
                $("#add_variation").addClass('disabled');
            }
        }
    }
    enableOrDisableAddingVariationsButton();
    $('.attribute_selector').on('change', function () {
        enableOrDisableAddingVariationsButton();
    });
    if ($('.attribute-selector').val().length > 0) {
        $("#add_variation:not('.disabled')").removeClass('disabled');
    }
    $("#add_variation").on('click', function (e) {
        var attributes = ($('.attribute-selector').val());
        if ($(this).hasClass('disabled')) {
            alert('Please add attributes');
            return;
        }
        $.ajax({
            url: add_variation_block_url,
            dataType: 'json',
            method: "POST",
            data: {'attributes': attributes, 'variation_blocks_count': $('.variation_block').length},
            success: function (data, status, xhr) {
                $('#product_variations').append(data.html);
                $('#variations_count').val(parseInt($('#variations_count').val()) + 1);
            },
            error: function (jqXhr, textStatus, errorMessage) {}
        });
    });

    $(document).on('click', '.delete-variation', function () {
        var variationContainer = $(this);
        if (variationContainer.hasClass('new-variation')) {
            variationContainer.closest('.variation_block').remove();
        } else {
            $.ajax({
                url: delete_variation_url,
                dataType: 'json',
                method: "POST",
                data: {
                    'variation_id': variationContainer.closest('.variation_block').find('.variation_id').val(),
                    '_token': $("[name='_token']").val()},
                beforeSend: function () {
                    $('#ajax-loading-icon').show();
                },
                success: function (data, status, xhr) {
                    variationContainer.closest('.variation_block').remove();
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert('Something went wrong, please try again');
                },
                complete: function () {
                    $('#ajax-loading-icon').hide();
                }
            });
        }
    });

    $(document).on('change', '.variation_block input', function () {
        $(this).closest('.variation_block').find('.variation-update-checker').val('yes');
    });


});