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
				<div id="icons" class="left">
					<a href="https://www.facebook.com/AsburyDesign"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook.png" alt="" /></a>
					<a href="https://twitter.com/AsburyDesign"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.png" alt="" /></a>
					<a href="mailto:steven@asburydesign.net"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/email.png" alt="" /></a>
				</div>
				<div id="footer-contact">
					1603 East 22nd Avenue<br />
					Eugene, OR 97403<br />
					<span class="contact-tel">p. 541-344-1633</span>
				</div>
				<div id="copyright">
					&copy; <?php echo date('Y'); ?> Asbury Design
				</div>
				<div class="clear"></div>
			</div><!-- .footer-container -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>