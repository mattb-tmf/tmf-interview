<?php
/**
 * Outputs the sidebar
 */
?>

<aside id="secondary" class="widget-area col-sm-12 col-lg-4" role="complementary">

<?php
	$version = $args['version'];

	switch($version){
		case "company":
			get_template_part( 'template-parts/sidebar-companyinfo' );
			break;

		case "stock":
			get_template_part( 'template-parts/sidebar-stockinfo' );
			break;

		default:
			break;
	}

?>

</aside><!-- #secondary -->