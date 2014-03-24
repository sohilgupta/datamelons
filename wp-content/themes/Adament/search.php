<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package fabframe
 */

get_header(); ?>
<div class="container"> <div class="row"> 
	<section id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="pages-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'fabframe' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php fabframe_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
</div></div>
<?php get_footer(); ?>
