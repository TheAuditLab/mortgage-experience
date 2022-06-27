<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
<section class="advisors-page-banner bg-purple">
    <div class="container">
        <div class="row">

            <div class="col-lg-1 px- me-1">
                <h3>Trust</h3>
            </div>
            <div class="col-lg-4 me--logo">
                <img src="<?php echo get_template_directory_uri();?>/dist/img/ME-Logo_white.svg" width="200" height="300"/>
                <h1>To make Mortgage Simple</h1>

                <div class="advisorsForm no-padding ">
                    <?php
                    $form = get_field( 'select_form' );
                    if ( class_exists( 'Ninja_Forms' ) ) {
                        Ninja_Forms()->display( $form[ 'id' ] );
                    }
                    ?>
                </div>
            </div>

            <div class="col-lg-4  offset-lg-1 advisor">
                <img src='<?php echo $backgroundImg[0]; ?>'>
                <h4><?php the_title(); ?></h4>
                <p><?php the_field('advisor_for'); ?></p>
                <?php if( have_rows('social_field') ): ?>
                    <div id="social-field">
                        <div class="social-div">
                            <?php while( have_rows('social_field') ): the_row(); ?>
                            <?php $social = get_sub_field('social') ?>
                            <?php $social_link = get_sub_field('social_link') ?>
                            <div class="social-details">
                                <a href="<?php echo $social_link ?>">
                                    <img src="<?php echo $social ?>">
                                </a>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?> 

            </div>

            <div class="advisorsText mobilehide">
                <?php the_field('intro_text'); ?>
            </div>

            <div class="advisorsText desktophide">
                <?php the_field('intro_text'); ?>
            </div>

        </div>
    </div>
    <div class="arrow-down mobilehide"></div>
</section>

<section >
    <div class="container">
        <div class="row">
            <div class="aboutAdvisor mobilehide">
                <?php the_field('about_advisor'); ?>
            </div>
        </div>
    </div>
</section>
