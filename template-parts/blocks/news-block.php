<?php
/**
 * Block Name: News preview
 *
 * This is the template that displays the news loop block.
 */
$url = get_permalink();
$uri = get_template_directory_uri();
$title = get_the_title();


$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12
);


// Get current page and append to custom query parameters array
$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$the_query = new WP_Query( $args );


while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="single-blog-post-wrap layout--2 layout-blog-page list-view" onclick="window.location.href=('<?php the_permalink(); ?>');">
        <div class="row">
            <div class="col-md-6">
                <?php the_post_thumbnail('artists-post-img'); ?>
                <figure class="blog-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <img src="https://picsum.photos/685/860" alt="<?php echo $title ?>" />
                    </a>
                    <figcaption class="blog-hvr-btn">
                        <span class="post-type"><i class="fa fa-play-circle-o"></i></span>
                    </figcaption>
                </figure>
            </div>

            <div class="col-md-6 my-auto">
                <div class="blog-post-details">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <?php the_excerpt(10); ?>

                    <a href="<?php the_permalink(); ?>" class="btn-read-more">Read More <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; ?>


<?php wp_reset_postdata();?>

<?php
// Custom query loop pagination
//previous_posts_link( 'Older Posts' );
//next_posts_link( 'Newer Posts', $the_query->max_num_pages );

// Reset main query object
$wp_query = NULL;

?>

<div class="pagination-content">

    <?php
    $total_pages = $the_query->max_num_pages;
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'mid_size'  => 6, // number of page links to display on either side of current page
            'prev_next'  => True,
            'prev_text' => __('<<'),
            'next_text' => __('>>'),
            'type' => 'list',
        ));
    }



    ?>

</div><!--end pagination-->
