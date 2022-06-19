<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mortgage-experience
 */

get_header();
?>


    <!--== Start Page Content Wrapper ==-->
    <div class="page-wrapper">
<?php
while ( have_posts() ) :
    the_post();

    get_template_part( 'template-parts/content', get_post_type() );

endwhile; // End of the loop.
?>
    <!--== End Page Content Wrapper ==-->

    </div>

<?php
get_footer();
