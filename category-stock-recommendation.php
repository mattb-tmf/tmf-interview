<?php
/**
 * The template for displaying Stock Recommendation Archive
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-8">
		<div id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php echo single_cat_title(); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				//prevent empty/malformed symbols from outputting
				if($symbol = getArticleStockSymbol()){ $heading_symbol = ' ('.$symbol.')'; }
				else{ $heading_symbol = ''; }

			?>

			<h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title() . $heading_symbol; ?></a></h2>

			<p><?php echo get_the_author() . ' | ' . get_the_date(); ?></p>

			<hr />

			<?php 

			endwhile;

			the_posts_navigation();

		endif; ?>

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
if(!is_archive()){ get_sidebar(null, array('version' => 'company')); } 
get_footer();
