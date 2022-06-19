<?php
$post_type = get_post_type( get_the_ID() );
get_template_part( 'headers/' . $post_type, 'header' );
?>



   

  <?php
		while ( have_posts() ) :
			the_post();
			$do_not_duplicate = $post->ID; // Add to first loop 		
			get_template_part( 'template-parts/content-advisers', get_post_type() );


			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

		?>
<?php

get_footer('advisers');
