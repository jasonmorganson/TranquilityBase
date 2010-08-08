<?php get_header(); ?>

<div id="main-container">


	<div id="sidebar-right-container">
	<div id="content-container">
	<div id="sidebar-left-container">
	
		<?php get_sidebar('left'); ?>
	
		<div id="content" class="both-sides">
		
			<?php get_template_part( 'loop' ); ?>
		
		</div>

		<?php get_sidebar('right'); ?>	
		
	</div>
	</div>
	</div>

</div>

<?php get_footer(); ?>
