<section class="right-image-block">
    <div class="container">
    <div class="row animatedDiv data-aos_fade-up data-aos-delay_100 data-aos-duration_400 orderBlocks4">
    <div class="col-lg-7 col-sm-12 align-self-center">
      <?php the_field('text'); ?>

        <?php
        $link = get_field('button');
        if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
<div class="l-r-button justify-content-start">
          <a class="btn bg-brand" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
</div>
        <?php endif; ?>
    </div>
    <div class="col-lg-4 offset-lg-1 col-sm-12 py-1 py-sm-5">
        <?php
        $image = get_field('image');
        if( !empty($image) ): ?>
            <img class="circular--square py-3 py-sm-1" src="<?php echo $image['url'];?>" />
        <?php endif; ?>
    </div>
    </div>
    </div>
</section>