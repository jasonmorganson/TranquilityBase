<?php
/*
Template Name: No Sidebars
*/ 
?>

<?php get_header(); ?>

<div id="container">

	<div id="sidebar-left-container">
	<div id="sidebar-right-container">
	
		<div id="content" class="no-sides">
		
			<?php get_template_part( 'loop' ); ?>
		
		</div>

	</div>
	</div>

</div>

<?php get_footer(); ?>

