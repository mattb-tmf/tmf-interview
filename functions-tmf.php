<?php

//Add Rewrite Rule for custom company info pages
add_action( 'init',  function() {
    add_rewrite_rule( '^company/([^/]+)/?$', 'index.php?symbol=$matches[1]', 'top' );
    add_rewrite_rule( '^company/([^/]+)/page/([0-9])/?$', 'index.php?symbol=$matches[1]&paged=$matches[2]', 'top' );
} );

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'symbol';
    return $query_vars;
} );

add_action( 'template_include', function( $template ) {
    if ( get_query_var( 'symbol' ) == false || get_query_var( 'symbol' ) == '' ) {
        return $template;
    }
 
    return get_template_directory() . '/page-companyinfo.php';
} );



function tmf_theme_activate(){
	//create cache folder if it doesnt exist after activating the theme
	$uploads = wp_get_upload_dir();
	if (!is_dir($uploads['basedir'].'/companyinfo/')) {
	    mkdir($uploads['basedir'].'/companyinfo/', 0777, true);
	}

	//create Stock Recommendation category for use if it doesnt exist
	wp_insert_term('Stock Recommendation', 'category', array(
		  'category_description'	=> 'Only assigned to articles that are stock recommendations.',
		  'slug'					=> 'stock-recommendation'
		)
	);
}
add_action( 'after_switch_theme', 'tmf_theme_activate' );



function getArticleStockSymbol(){
	global $post;

	$stock_symbols = get_the_terms($post,'stock-symbol');

	if(sizeof($stock_symbols))
		return $stock_symbols[0]->name;
	else 
		return false;
}


function tmf_add_stock_taxonomy() {
   register_taxonomy('stock-symbol', 'post', array(
    'hierarchical' => false,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'labels' => array(
      'name' => _x( 'Stock Symbol', 'taxonomy general name' ),
      'singular_name' => _x( 'Stock Symbol', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Symbols' ),
      'all_items' => __( 'All Stock Symbols' ),
      'edit_item' => __( 'Edit Symbol' ),
      'update_item' => __( 'Update Symbol' ),
      'add_new_item' => __( 'Add Stock Symbol' ),
      'new_item_name' => __( 'New Stock Symbol' ),
      'menu_name' => __( 'Stock Symbols' ),
    ),
    'rewrite' => array(
      'slug' => 'stock-symbol', 
      'with_front' => false, 
      'hierarchical' => false 
    ),
  ));
}
add_action( 'init', 'tmf_add_stock_taxonomy', 0 );


include "class.stock.php";

