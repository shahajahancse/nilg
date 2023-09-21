$( function() {
    $( '#tabs' ).tabs({
        fx: { height: 'toggle', opacity: 'toggle' }
    });

    $.ajax({
        url: 'index.php/book_con/readBook',
        dataType: 'json',
        success: function( response ) {
            $( '#readTemp' ).render( response ).appendTo( "#tabel" );
        }
    });

	$.ajax({
        url: 'index.php/book_con/readMember',
        dataType: 'json',
        success: function( response ) {
            $( '#readTemp2' ).render( response ).appendTo( "#tabel2" );
        }
    });

});

