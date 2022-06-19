<style>
    .first-step .wrapper {
        height: auto;
        padding-bottom: 215px;
    }

    .first-step .quote-box{
        text-align: center;
        height: auto;
        padding: 20px;
        background: #483a5e;
        color: #ffffff;
        top: -20px;
        position: relative;
        z-index: 2;
    }
</style>

<section class="first-step animatedDiv data-aos_fade-up data-aos-delay_100 data-aos-duration_400s">
    <div class="container wrapper">
        <div class="row">
                <div class="col-lg-6 left-image mobilehide">
                    <?php $first_step_left_image = get_field('first_step_left_image');  ?>
                    <img src="<?php echo $first_step_left_image['url'];?>" />
                    <div class="quote-box">"We could make the impossible, <strong>possible</strong>"</div>
                </div>

                <div class="col-lg-4 offset-lg-2 right-content align-self-center">
                    <h3> <?php the_field('first_step_heading'); ?></h3>
                    <?php the_field('first_step_text'); ?>

                    <?php if( have_rows('button') ): ?>
                        <?php while( have_rows('button') ): the_row(); ?>
                            <div class="pt-2"> <a class="btn button-primary slide-button" href="<?php the_sub_field('button_url'); ?>"> <strong><?php the_sub_field('button_text'); ?></strong></a></div>
                        <?php endwhile; ?>
                    <?php endif;?>
                </div>

            <div class="col-lg-6 left-image mobile-left-image desktophide">
                <?php $first_step_left_image = get_field('first_step_left_image');  ?>
                <img src="<?php echo $first_step_left_image['url'];?>" />
            </div>

        </div>
    </div>
</section>