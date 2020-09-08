
$(document).ready(function () {
//    $(".js-range-slider").ionRangeSlider();

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




$(document).on('click', '#close-preview', function () {
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
            function () {
                $('.image-preview').popover('show');
            },
            function () {
                $('.image-preview').popover('hide');
            }
    );
});

$(document).on('click', '#toggle_popover', function () {
    if ($(this).hasClass('popover-shown')) {
        $(this).removeClass('popover-shown');
        $(this).addClass('popover-hidden');
        $('.image-preview').popover('hide');
    } else {
        $(this).removeClass('popover-hidden');
        $(this).addClass('popover-shown');
        $('.image-preview').popover('show');
    }

});


$(function () {


    var previewContent = 'No preview';
    if ($('#product_image').val !== '') {
        $(".image-preview-input-title").text("Change");
        $('#toggle_popover').show();
        $("#toggle_popover").addClass('popover-hidden');
        previewContent = initiatePopoverContent($(".image-preview-input input:file"));
    }

    // Set the popover default content
    $('.image-preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Preview</strong>",
        content: previewContent,
        placement: 'bottom'
    });

    // Clear event
    $('.image-preview-clear').click(function () {
        $('.image-preview').attr("data-content", "").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse");
    });

    // Create the preview image
    $(".image-preview-input input:file").change(function () {
        // Set preview image into the popover data-content
        $(".image-preview-input-title").text("Change");
        $(".image-preview-clear").show();

        initiatePopoverContent(this);
        $('#toggle_popover').show();
        $("#toggle_popover").addClass('popover-shown');
    });

    function initiatePopoverContent(fileInput) {
        if (fileInput.files) {
            var file = fileInput.files[0];
            var img = $('<img/>', {
                id: 'dynamic',
                width: 250,
                height: 200
            });
            $(".image-preview-filename").val(file.name);
            var myImage = null;
            var reader = new FileReader();
            reader.onload = function (e) {


                img.attr('src', e.target.result);
                myImage = (img)[0].outerHTML;
                $('.image-preview').attr('data-content', myImage).popover('show');
            };
            reader.readAsDataURL(file);
            return;
        }
        if ($(fileInput).attr('value')) {
            $('.image-preview-filename').val($(fileInput).attr('value'));
            return exitingImage = '<img src="' + productsUploadPath + '/' + $(fileInput).attr('value') + '" />';
        }

        if (!fileInput.files && !fileInput.attr('value')) {
            return 'No preview';
        }
    }
});