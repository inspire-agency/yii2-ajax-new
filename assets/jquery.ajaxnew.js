(function ( $ ) {
 
    $.fn.ajaxNew = function( options ) {
 
        var settings = $.extend({
            selector: null,
            url: null,
        }, options );
 
        var self = $(this);

        return this.on('submit', 'form', function() {
            console.log('submitting');
            var form = $(this);
            $.post(
                form.attr("action"),
                form.serialize()
            )
            .done(function(data) {
                console.log(data, settings);
                if ('object' == typeof data) {
                    self.modal('hide');
                    $(settings.selector)
                        .append($('<option />', { value: data.id}).text(data.label))
                        .val(data.id);
                } else { // html
                    form.find('.modal-body').html($('<div>' + data + '</div>'));
                }
            })
            .fail(function() {
                console.log("server error");
            });
            return false;
        }).on('hidden.bs.modal', function () {
            $(this).data('bs.modal', null);
        }).on('show.bs.modal', function () {
            var _self = this;
            $.get(settings.url, function(data) {
                $(_self).find('.modal-body').html(data);
            });
        });

    };
 
}(jQuery));