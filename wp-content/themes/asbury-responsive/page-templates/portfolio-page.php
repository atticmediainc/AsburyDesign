<?php
/**
 * Template Name: Portfolio Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

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
						<div id="portfolio-content"><?php the_content(); ?></div>
						
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
									
									<?php if ($order == 1) : ?>
								    <li id="<?php echo $cat_name; ?>" class='active-category first'><a href="<?php echo $cat_url ?>"><?php the_title(); ?></a></li>
									<?php elseif ($cat_name == "branding") : ?>
									<li id="<?php echo $cat_name; ?>"><a href='<?php echo $cat_url ?>'><?php the_title(); ?> & Corporate Identity</a></li>
									<?php else : ?>
									<li id="<?php echo $cat_name; ?>"><a href='<?php echo $cat_url ?>'><?php the_title(); ?></a></li>
									<?php endif; ?>
									
									
								<?php endwhile; ?>
								<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
							</ul>
						</div><!-- #portfolio-menu -->
						<div class="clear"></div>
						<!-- Show only Publication projects on the Portfolio page -->
						<div id="project-container">
							<?php $count = 1; ?>
							<?php $loop = new WP_Query( array( 'category_name' => 'advertising', 'posts_per_page' => -1 ) ); ?>

							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<?php // get url of featured image ?>
								<?php $featured_id = get_post_thumbnail_id(); ?>
								<?php $featured_url = wp_get_attachment_image_src($featured_id,'full', true); ?>
								
								<!-- set featured image as target for fancybox, display thumbnail with content on hover -->
								<a href="<?php echo $featured_url[0]; ?>" class="fancybox">
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
					</div><!-- .entry-content -->

				</article><!-- #post -->

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>