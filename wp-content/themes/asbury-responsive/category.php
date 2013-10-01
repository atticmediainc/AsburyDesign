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
					
					<p id="current-page"><?php $current = single_cat_title("", false); echo strtolower($current); ?></p>  

					<div id="portfolio-menu">
						<h3 class="portfolio-menu-toggle">Toggle</h3>
						<ul>
							<?php
							$args = array(
							  'orderby' => 'ID',
							  'order' => 'ASC',
							  'hide_empty' => 0,
							  'include' => '5,6,7,8,9,10,11'
							  );
							$categories = get_categories($args);
							  $count = 1;
							  foreach($categories as $category) { 
							  	$cat_url = site_url() . '/portfolio/' . $category->slug;
							  		if ($count == 1) {
							  	    echo "<li id={$category->slug} class='active-project first'><a href='{$cat_url}'>{$category->name}</a></li>";
							  	} else { echo "<li id='{$category->slug}'><a href='{$cat_url}'>{$category->name}</a></li>";  }
							  	$count++;
							  }
							?>
						</ul>
					</div><!-- #portfolio-menu -->
					<div class="clear"></div>
					<div id="project-container">
						<?php $count = 1; ?>
						<?php /* The loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
							
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
					</div><!-- #project-container -->
			<?php twentythirteen_paging_nav(); ?>
					
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