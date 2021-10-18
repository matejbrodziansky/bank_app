// var base_url = window.location.origin;

var flashMessage = function (color, message, time, status) {
    var flash = $('.alert'),
        strong = flash.find(strong),
        type = typeof (message),
        altEl = $('.alert-elements').remove();

    flash.hide();
    altEl.remove()

    flash.show().css("background-color", color)

    if (typeof (message) == 'object') {
        $.each(message, function (index, value) {
            flash.append('<p class="alert-elements">' + value + '</p');
        });
    } else {
        flash.append('<p class="alert-elements">' + message + '</p');
    }
    flash.delay(time).fadeOut('slow', function () {
        $('.alert-elements').remove();
    });
}

