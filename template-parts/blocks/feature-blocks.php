<?php if (have_rows('feature_blocks')): ?>
    <div class="container-fluid">
        <div class="row">
             <?php while (have_rows('feature_blocks')): the_row(); ?>
          <?php
                $image = get_sub_field('block_image');
                if( !empty($image) ): ?>
                <div class="col-lg-6 col-sm-12 col-xs-12 featureBlock animatedDiv data-aos_fade-up data-aos-delay_100 data-aos-duration_400"
                     style="background-image: url(<?php echo $image['url']; ?>);">
                <?php endif; ?>

                 <?php
                 $link = get_sub_field('link');
             if( $link ):
                 $link_url = $link['url'];
                 $link_title = $link['title'];
                 $link_target = $link['target'] ? $link['target'] : '_self';
                 ?>
             <div class="innerContent" onclick="location.href='<?php echo esc_url($link_url); ?>'">
                <h3> <?php the_sub_field('title'); ?></h3>
                <p> <?php echo wp_kses(get_sub_field('strapline'), array('br' => array())); ?></p>
<p>&nbsp;</p>
                     <a class="btn brandBtn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                 <?php endif; ?>

                </div>
                 <div class="featureOverlay"></div>
                 </div>
             <?php endwhile; ?>

        </div>
    </div>
<?php endif; ?>

