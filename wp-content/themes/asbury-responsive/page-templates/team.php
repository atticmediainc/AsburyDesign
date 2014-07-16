<?php
/**
 * Template Name: Team Member Template
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<?php if ($feat_image) : ?>
<div class="featured-image-wrapper"><div class="featured-image" <?php set_slide_bg($feat_image); ?>></div></div>
<?php endif; ?>

<div id="main-container">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<div class="team-contact">
						<?php if(get_field('linked_in')) : ?>
						<a class="team-icon" href="<?php the_field('linked_in'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/team-linkedin.png" alt="LinkeIn Icon" /></a>
						<?php endif; ?>
						<?php if(get_field('twitter')) : ?>
						<a class="team-icon" href="<?php the_field('twitter'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/team-twitter.png" alt="Twitter Icon" /></a>
						<?php endif; ?>
						<?php if(get_field('team_email')) : ?>
						<a class="team-icon" href="mailto:<?php the_field('team_email'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/team-email.png" alt="Email Icon" /></a>
						<?php endif; ?>
					</div>
				</article><!-- #post -->

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>