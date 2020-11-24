<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-8">
		<div id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			
			if($symbol = getArticleStockSymbol()){
				$STOCK = new Stock($symbol);
			}

			get_template_part( 'template-parts/content' );

		endwhile; // End of the loop.
		?>

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
//decide which sidebar to use...aka...only show sidebar if a stock recommendation post
(has_category(array('stock-recommendation'))) ? $sidebar_version = 'company' : $sidebar_version = '';
get_sidebar(null, array('version' => "$sidebar_version")); 

get_footer();
