
<div class="col call-to-action-box bg-<?php the_field('cta_background_color'); ?> animatedDiv data-aos_fade-up  data-aos-delay_100 data-aos-duration_400">

    <div class="cta-icon d-flex justify-content-end">
        <i class="<?php the_field('icon'); ?>"></i>

    </div>
    <div class="cta-heading d-flex justify-content-center">
        <h5><?php the_field('cta_heading'); ?></h5>
    </div>
    <div class="cta-text d-flex justify-content-center">
        <?php the_field('cta_text'); ?>
    </div>
    <div class="cta-button d-flex justify-content-center align-items-end">
        <?php
        $link = get_field('link');
        if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="btn brandBtn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
       <?php else :
            {
            ?>
                <a class="btn brandBtn" onclick="$zoho.salesiq.floatwindow.visible('show')">Open Chat </a>

        <?php
            }
            ?>
        <?php endif; ?>
    </div>

</div>
