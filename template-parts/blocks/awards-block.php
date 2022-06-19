<section class="awardsBlock animatedDiv data-aos_fade-up data-aos-delay_100 data-aos-duration_400">
<div class="container">
<div class="row">

    <div class="col-lg-5">
        <h3> <?php the_field('awards_intro'); ?></h3>
    </div>

    <div class="col-lg-5">
        <?php if (have_rows('awards')): ?>
        <?php while (have_rows('awards')): the_row(); ?>
        <div class="d-flex flex-row">
                <?php
                $awards_image = get_sub_field('awards_image');
                if( !empty($awards_image) ): ?>
            <div class="awardsImg d-flex align-self-center justify-content-lg-end justify-content-sm-start"> <?php $awards_image = get_sub_field('awards_image');  ?>
                <img src="<?php echo $awards_image['url'];?>" />
            </div>
            <?php endif; ?>
            <div class="awardsCopy align-self-center justify-content-start">
                <?php the_sub_field('awards_text'); ?>
            </div>

        </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>



</div>
</div>
</section>