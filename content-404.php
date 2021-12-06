<?php
/**
 * The template for displaying 404 pages.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="inside-article" data-aos="flip-right" data-aos-easing="ease-out-cubic" data-aos-duration="1000"
    data-aos-offset="-5>

    <?php
	/**
	 * generate_before_content hook.
	 *
	 * @since 0.1
	 *
	 * @hooked generate_featured_page_header_inside_single - 10
	 */
	do_action( 'generate_before_content' );
	?>

    <header <?php generate_do_attr( 'entry-header' ); ?>>
        <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML is allowed in filter here. ?>
        <h1 class=" entry-title" itemprop="headline">
    <?php echo apply_filters( 'generate_404_title', __( 'Oops! That page can&rsquo;t be found.', 'generatepress' ) ); ?>
    </h1>
    </header>

    <?php
	/**
	 * generate_after_entry_header hook.
	 *
	 * @since 0.1
	 *
	 * @hooked generate_post_image - 10
	 */
	do_action( 'generate_after_entry_header' );

	$itemprop = '';

	if ( 'microdata' === generate_get_schema_type() ) {
		$itemprop = ' itemprop="text"';
	}
	?>

    <?php
	/**
	 * generate_after_content hook.
	 *
	 * @since 0.1
	 */
	do_action( 'generate_after_content' );
	?>

</div>