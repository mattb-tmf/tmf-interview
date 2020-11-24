<?php
//Gets stock recommendation articles for a given symbol
global $STOCK;

$args = array('post_type' => 'post',  
			  'post_status' => 'publish',
			  'posts_per_page' => 10, 
			  'paged' => $paged, 
			  'orderby' => 'date',  
			  'tax_query' => array('relation' => 'AND',
                    array(
                        'taxonomy' => 'stock-symbol',
                        'field' => 'slug',
                        'terms' => array ($STOCK->longSymbol)
                    ),
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => array ("stock-recommendation"),
                        'operator' => 'NOT IN'
                    )
                )

                
			);

$related = new WP_Query( $args );

if($related->have_posts()){
	echo "<h2 id='coverage'>Other Coverage</h2>
			<ul>";

	while($related->have_posts()){

		$related->the_post();

		echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

	}

	echo '</ul>';

	if($related->max_num_pages > 1){
		$big = 999999999; 
	 	
		echo paginate_links( array(
		    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		    'format' => '?paged=%#%',
		    'current' => max( 1, get_query_var('paged') ),
		    'total' => $related->max_num_pages,
		    'add_fragment' => '#coverage',
		) );
	}
}

wp_reset_query();

?>