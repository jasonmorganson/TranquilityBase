<?php
/*
Template Name: Left Sidebar Only
*/ 
?>

<?php get_header(); ?>

<div id="main-container">


	<div id="sidebar-right-container">
	<div id="content-container">
	<div id="sidebar-left-container">
	
		<?php get_sidebar('left'); ?>
	
		<div id="content" class="left-only">
		
			<?php get_template_part( 'loop' ); ?>
		
		</div>

	</div>
	</div>
	</div>

</div>

<?php get_footer(); ?>
