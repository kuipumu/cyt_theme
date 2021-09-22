<?php
/**
 * Template for displaying search forms.
 *
 * @package WordPress
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search', 'cyt' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'cyt' ); ?>" value="" name="s">
	</label>
	<button class="search-submit"><i class="fas fa-search"></i></button>
</form>
