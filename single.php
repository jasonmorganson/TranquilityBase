<?php get_header(); ?>

<div id="main-container">


	<div id="sidebar-right-container">
	<div id="content-container">
	<div id="sidebar-left-container">
	
		<?php get_sidebar('left'); ?>
	
		<div id="content" class="both-sides">
		

		<?php if( have_posts() ) : ?>
		
			<?php while( have_posts() ) : the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
					<div class="entry-header">
					
						<div class="entry-title">
							<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						</div>
				
						<div class="entry-meta">
						<?php
							
							if( is_category( 'news' ) ) {
								posted_on();
							}
						?>
						</div>
						
					</div>
					
					<?php the_content( ); ?>
		
				</div>
		
			<?php endwhile; ?>
		
		<?php else : ?>
		
			<h1>Not Found</h1>
			<p>Sorry, but you are looking for something that isn't here.</p>
		
		<?php endif; ?>
		
		</div>

		<?php get_sidebar('right'); ?>	
		
	</div>
	</div>
	</div>

</div>

<?php get_footer(); ?>
