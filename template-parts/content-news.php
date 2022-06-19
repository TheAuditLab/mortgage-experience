<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mortgage-experience
 */

get_header();
?>


    <!--== Start Page Header Area ==-->
    <div class="page-header-wrapper bg-offwhite" style="background-image: url("<?php the_post_thumbnail_url(); ?>"); background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="page-header-content d-flex">
                        <h1>News</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area ==-->
    <!--== Start Page Content Wrapper ==-->
    <div class="page-wrapper">
    <div class="blog-page-content-wrapper fix mt-120 mt-md-80 mt-sm-60">
    <div class="container">
    <div class="row">
    <div class="col-12">
        <div class="blog-list-content split-view mtm-44">

            <!-- Single Blog Post Start -->
            <?php the_content(); ?>
            <!-- Single Blog Post End -->

</div>
</div>
    </div>
    </div>
    </div>
    </div>
<?php

get_footer();