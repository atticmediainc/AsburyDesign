<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="footer-container">
				<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
					<div class="wrap">
						<?php dynamic_sidebar( 'footer-widget' ); ?>
						<div class="back-to-top"><a href="#page">Back to Top</a></div>
					</div>
					<div class="clear"></div>
				<?php endif; ?>
			</div><!-- .footer-container -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>