/**
 * Ajax function to search through products and suggest it to the person trying to add a sale
 */
function suggetion() {

    $('#sug_input').keyup(function (e) {

        var formData = {
            'product_name': $('input[name=title]').val()
        };

        if (formData['product_name'].length >= 1) {

            $.ajax({
                type: 'POST',
                url: 'suggestion.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
                .done(function (data) {
                    $('#result').html(data).fadeIn();
                    $('#result li').click(function () {

                        $('#sug_input').val($(this).text());
                        $('#result').fadeOut(500);

                    });

                    $("#sug_input").blur(function () {
                        $("#result").fadeOut(500);
                    });

                });

        } else {

            $("#result").hide();
        }

        e.preventDefault();
    });

}

/**
 * Total price with quantity.
 */
function total() {
    $('#product_info input').change(function (e) {
        var price = +$('input[name=price]').val() || 0;
        var qty = +$('input[name=quantity]').val() || 0;
        var total = qty * price;
        $('input[name=total]').val(total.toFixed(2));
    });
}

/**
 * Submit from the suggestion form into the add sale form
 */
$('#sug-form').submit(function (e) {
    var formData = {
        'p_name': $('input[name=title]').val()
    };

    $.ajax({
        type: 'POST',
        url: 'suggestion.php',
        data: formData,
        dataType: 'json',
        encode: true
    }).done(function (data) {
        $('#product_info').html(data).show();
        total();
        $('.datePicker').datepicker('update', new Date());

    }).fail(function (data) {
        $('#product_info').html(data).show();
    });
    e.preventDefault();
});


/**
 * Toggle function that handles the tooltip of the edit and delete actions
 */
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('.submenu-toggle').click(function () {
        $(this).parent().children('ul.submenu').toggle(200);
    });
    suggetion();
    total();

    $('.datepicker')
        .datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            autoclose: true
        });
});
