<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<div id="main-container">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		<?php if ( have_posts() ) : ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title">Portfolio</h1>
				</header><!-- .entry-header -->
				
				<div class="entry-content">
					<div id="portfolio-content">Our work covers the complete range of advertising, branding, and design. We’re known for our award-winning visuals, but our focus is on communication and strategic positioning.</div>
					
					<p id="current-page"><?php $current = single_cat_title("", false); echo strtolower($current); ?></p>  

					<div id="portfolio-menu">
						<h3 class="portfolio-menu-toggle">Toggle</h3>
						<ul>
							<?php $loop = new WP_Query( array( 'category_name' => 'project-category', 
															'posts_per_page' => -1,
															'meta_key'		=> 'category_menu_order',
															'orderby'		=> 'meta_value_num',
															'order' => 'ASC'
							) ); ?>
							
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<?php $cat_name = strtolower($post->post_name); ?>
								<?php $cat_url = site_url() . '/portfolio/' . $cat_name; ?>
								<?php $order = get_field( "category_menu_order" ); ?>
								
								<?php if ($cat_name == "branding") : ?>
								<li id="<?php echo $cat_name; ?>"><a href='<?php echo $cat_url ?>'><?php the_title(); ?> &amp; Corporate Identity</a></li>
								<?php else : ?>
								<li id="<?php echo $cat_name; ?>"><a href='<?php echo $cat_url ?>'><?php the_title(); ?></a></li>
								<?php endif; ?>
								
								
							<?php endwhile; ?>
							<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
						</ul>
					</div><!-- #portfolio-menu -->
					<div class="clear"></div>
					<div id="project-container">
						<?php $count = 1; ?>
						<?php /* The loop */ ?>
						<?php $currentCategory = single_cat_title("", false); ?>
						<?php $loop =  new WP_Query( array(
						    					'category_name' => $currentCategory,
						    					'posts_per_page' => -1 ) ); ?>
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							
							<?php // get url of featured image ?>
							<?php $featured_id = get_post_thumbnail_id(); ?>
							<?php $featured_url = wp_get_attachment_image_src($featured_id,'full', true); ?>
							
							<!-- if a video project link to vimeo URL -->
							<?php if (in_category(12)) : ?>
							<a href="<?php the_field('vimeo_url'); ?>" class="fancybox">
							<?php else : ?>
							<!-- otherwise set featured image as target for fancybox -->
							<a href="<?php echo $featured_url[0]; ?>" class="fancybox">
							<?php endif; ?>
								<div <?php echo ($count == 1 ? 'class="project first"' : 'class="project"'); ?>>
									<div class="project-thumb"><img src="<?php the_field('portfolio_thumbnail'); ?>" alt="" /></div>
									<div class="project-popup">
										<?php the_content(); ?>
									</div>
								</div>
							</a>
							<?php $count++; ?>
							
						<?php endwhile; ?>
						<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>  
					</div><!-- #project-container -->
					
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
			
				</div><!-- .entry-content -->
			</article><!-- #post -->

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>