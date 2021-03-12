(function( $ ){

    var methods = {
        init : function( options ) {
            return this.each(function () {

                var $tree = $(this);

                $tree.on('click', '.tree-list__label', function(e) {
                    e.preventDefault();
                    var row = $(this).parent();
                    row.toggleClass('visible');
                    if (row.next().hasClass('show')) {
                        row.next().removeClass('show');
                        row.next().slideUp(350);
                    } else {
                        row.next().toggleClass('show');
                        row.next().slideToggle(350);
                    }
                })
            });
        }
    };

    $.fn.tree = function( method ) {

        // логика вызова метода
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' + method + ' does not exist on jQuery.categoriestree' );
        }
    };

})( jQuery );