<?php global $shortname; ?>

<?php get_header(); ?>

<div id="main-container">


	<div id="sidebar-right-container">
	<div id="content-container">
	<div id="sidebar-left-container">
	
		<?php get_sidebar('left'); ?>
	
		<div id="content" class="both-sides">
		
			<div class="404 page type-page hentry category-uncategorized">
		
				<h1><?php _e("Not Found", $shortname); ?></h1>

				<p class="center"><?php _e("Sorry, but nothing matched your search criteria. Please try again with some different keywords.", $shortname); ?></p>
				<?php get_search_form(); ?>

				<!-- Google 404 Widget -->
				<script type="text/javascript">
				  var GOOG_FIXURL_LANG = '<?php echo ICL_LANGUAGE_CODE; ?>';
				  var GOOG_FIXURL_SITE = '<?php echo wpml_get_home_url(); ?>'
				</script>
				<script type="text/javascript"
				  src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js">
				</script>

			</div>
		
		</div>

		<?php get_sidebar('right'); ?>	
		
	</div>
	</div>
	</div>

</div>

<?php get_footer(); ?>

