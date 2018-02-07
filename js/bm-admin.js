// Listen for BitMate Notice being dismissed and track which notice is being dismissed,
jQuery(function($) {
$( document ).on( 'click', '.notice-bm-ad .notice-dismiss', function () {
    var type = $( this ).closest( '.notice-bm-ad' ).data( 'notice' );
    $.ajax( ajaxurl,
      {
        type: 'POST',
        data: {
          action: 'dismissed_notice_handler',
          type: type,
        }
      } );
  } );
});