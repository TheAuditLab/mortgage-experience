<section class="bg-<?php the_field('background_color'); ?> d-flex align-items-center  animatedDiv data-aos_fade-up  data-aos-delay_100 data-aos-duration_400">
    <div class="personal-approach">
    <div class="container">
        <div class="row">
    <div class="col approachImage">
        <?php $approach_left_image = get_field('approach_left_image');  ?>
        <img src="<?php echo $approach_left_image['url'];?>" />
    </div>

            <div class="col d-flex flex-column justify-content-start align-self-center approachCopy">
                 <h3><?php the_field('approach_heading'); ?></h3>
               <p class="pb-3"><?php the_field('approach_text'); ?></p>
                <?php if( have_rows('button') ): ?>
                <?php while( have_rows('button') ): the_row(); ?>
                            <a class="btn brandBtn" href="<?php the_sub_field('button_url'); ?>"> <?php the_sub_field('button_text'); ?></a>
                        <?php endwhile; ?>
                    <?php endif;?>





            </div>
        </div>
    </div>
    </div>
</section>
