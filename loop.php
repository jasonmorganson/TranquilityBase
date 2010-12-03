
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
			
			<?php
				global $more;
				$more = 0;
			?>
			
			<?php the_content( 'Read more...' ); ?>

		</div>

	<?php endwhile; ?>

<?php else : ?>

	<h1>Not Found</h1>
	<p>Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>