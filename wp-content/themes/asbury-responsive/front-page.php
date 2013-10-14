<?php
/**
 * The template for displaying the front page.
 */

get_header(); ?>

<div id="slideshow-wrapper">
	<div id="slideshow-container">
		<div id="slideshow">
			<div class="bxslider">
				<?php $loop = new WP_Query( array( 
											'category_name' => 'slideshow-image', 
											'orderby' => 'title', 
											'order' => 'ASC' ) ); ?>
				
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div>
						<!-- Get slide image -->
						<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
						
						<!-- Construct URL using ACF select field -->
						<?php
						$field = get_field_object('project_type');
						$value = get_field('project_type');
						$label = $field['choices'][ $value ];
						$link = site_url() . '/portfolio/' . $value;
						?>

						<!-- Get the project type from custom field value -->
						<?php $project_field = get_post_meta(get_the_ID(), 'slideshow_project', true); ?>
						
						<div class="slider-img" <?php set_slide_bg($feat_image); ?>>
							<div class="wrap">
								<div class="slide-content">
									<a href="<?php echo $link; ?>"><?php echo $label; ?> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider-content-arrow.png" alt="" title="" class="slide-title-arrow"></a>
									<p><?php the_title(); ?></p>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>  
			</div>
		</div><!-- /slideshow -->
	</div><!-- /slideshow-container -->
</div><!-- /slideshow-wrapper -->

<div id="main-container">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php the_content(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>