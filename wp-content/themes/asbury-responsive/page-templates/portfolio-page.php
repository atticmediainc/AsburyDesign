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
						
						<div id="portfolio-menu">
							<ul>
								<?php
								$args = array(
								  'orderby' => 'slug',
								  'order' => 'ASC',
								  'hide_empty' => 0,
								  'parent' => 4
								  );
								$categories = get_categories($args);
								  $count = 1;
								  foreach($categories as $category) { 
								  	if ($count == 1) {
									    echo "<li id={$category->slug} class='active-project'>{$category->name}</li>";
								    } else { echo "<li id='{$category->slug}'>{$category->name}</li>";  }
								    $count++;
								  }
								?>
							</ul>
						</div>
						
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

				</article><!-- #post -->

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>