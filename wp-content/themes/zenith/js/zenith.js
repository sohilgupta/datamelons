/**
 * Zenith theme jQuery.
 */
$j = jQuery.noConflict();

$j(document).ready(

	function() {
		
		/* Add drop-down indicators to all menu items with a sub menu */
		$j( '.nav li:has(ul) > a' ).append( '<span class="caret"></span>' );
		
		/* Toggle .not selector */
		$j( '.btn-navbar' ).click(function() {
		  $j( this ).next( '.nav-collapse' ).toggleClass( 'not' );
		});

	}

);