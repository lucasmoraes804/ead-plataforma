$( document ).ready( function() {

    if ( $( document ).find( '.mask-phone' ).length ){
        $( '.mask-phone' ).focusout(function(){
            var phone, element;
            element = $( this );
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }).trigger('focusout');
    }

    if ( $( document ).find( '.mask-date' ).length ){
        $( '.mask-date' ).mask( '99/99/9999' );
    }

    if ( $( document ).find( '.btn-delete' ).length ){
        $( '.btn-delete' ).click( function( e ) {
            var dialog = confirm( 'Você tem certeza que deseja excluír o conteúdo?' );
            if ( dialog !== true ) {
                e.preventDefault();
            }
        });
    }

});