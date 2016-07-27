/**
 * Sonorous theme jQuery.
 */
$j = jQuery.noConflict();

$j(document).ready(

	function() {
		
		/* Add drop-down indicators to all menu items with a sub menu */
		$j( 'div.menu li:has(ul.sub-menu) > a' ).addClass( 'with-ul' ).append( '<span class="sub-indicator">&raquo;</span>' );
		
		$j( '#menu-primary-title' ).click(function() {
		  $j( '#menu-primary .menu' ).toggleClass( 'visible' );
		});
		
		$j( '#header a.login-link' ).click(function() {
		  $j( '#sonorous-loginform' ).toggleClass( 'visible' );
		});

	}

);