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
											'meta_key'		=> 'slide_order',
											'orderby'		=> 'meta_value_num', 
											'order' => 'ASC' ) ); ?>
				
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div>
						<!-- Get slide image -->
						<?php $slide_url = get_field('slide_image'); ?>
						
						
						<!-- Construct URL using ACF select field -->
						<?php
						$field = get_field_object('project_type');
						$value = get_field('project_type');
						$label = $field['choices'][ $value ];
						$link = site_url() . '/portfolio/' . $value;
						$color = get_field('text_color');
						?>

						<!-- Get the project type from custom field value -->
						<?php $project_field = get_post_meta(get_the_ID(), 'slideshow_project', true); ?>
						
						<div class="slider-img" <?php set_slide_bg($slide_url); ?>>
							<div class="wrap">
								<a href="<?php echo $link; ?>"><div class="slide-content">
									<h4 style="color:<?php echo $color; ?>;"><?php echo $label; ?></h4>
									<p style="color:<?php echo $color; ?>;"><?php the_title(); ?></p>
								</div></a>
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
			<div id="home-featured">
				<?php $loop = new WP_Query( array( 
											'category_name' => 'front-page', 
											'posts_per_page' => 3,
											'order' => 'ASC' ) ); ?>
				
				<?php if ($loop) : ?>
				<?php $count = count($loop); ?>
				<?php $index = 1; ?>
				<ul>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li <?php if($index == 3) echo "class='last'"; $index++; ?>>
						<?php if (in_category(12)) : // if a video project link to vimeo URL ?>
						<a href="<?php the_field('vimeo_url'); ?>" class="fancybox">
						<?php else : ?>
						<?php $featured_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
						<a href="<?php echo $featured_url; ?>" class="fancybox">
						<?php endif; ?>
						<?php $thumbnail = get_field('portfolio_thumbnail'); ?>
						<?php if ($thumbnail) : ?>
						<div class="featured-thumb"><img src="<?php echo $thumbnail; ?>" /></div>
						<div class="featured-info">
							<?php
							$categories = get_the_category();
							$output = '';
							if($categories){
								foreach($categories as $category) {
									if ($category->cat_name != 'Front Page') {
										$output .= '<span>' . $category->cat_name . '</span><br />';
									}
								}
							echo $output;
							}
							?>
							<?php the_title(); ?>
						</div>
						<?php endif; ?>
						</a>
					</li>
				<?php endwhile; ?>
				</ul>
				<?php endif; ?>
				<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>