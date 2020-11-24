
<?php
global $STOCK;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<h1><?php the_title(); ?></h1>
		
		<div class="entry-meta">
			<?php echo get_the_author() . ' | ' . get_the_date(); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">
		<p class="mt-3 mb-5 text-muted">TMF Company Profile: (<a href="<?php echo site_url('/company/'.$STOCK->longSymbol.'/'); ?>"><?= $STOCK->longSymbol; ?></a>)</p>

		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wp_bootstrap_starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
