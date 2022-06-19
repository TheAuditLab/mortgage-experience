<section class="page-banner">

    <div class="sliderAnimation">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-sm-12 left-banner-image-right d-flex flex-column under-heading">
                    <h1><?php the_field('heading'); ?> </h1>
                    <div class="sliderMEImage mobilehide">

                        <?php
                        $left_image = get_field('left_image');
                        if( !empty($left_image) ): ?>
                            <img src="<?php echo $left_image['url']; ?>" alt="<?php echo $left_image['alt']; ?>" />
                        <?php endif; ?>

                    </div>
                    <p><?php the_field('slide_text'); ?></p>

                    <div class="d-flex flex-row mobilehide">
                        <?php if( have_rows('button') ): ?>
                            <?php while( have_rows('button') ): the_row(); ?>
                        <div class="col pb-20">  <a class="btn button-primary slide-button" href="<?php the_sub_field('button_url'); ?>"> <?php the_sub_field('button_text'); ?></a></div>
                            <?php endwhile; ?>
                        <?php endif;?>

                    </div>

                    <div class="d-flex flex-row desktophide">
                        <?php
                        $link = get_field('mobile_button');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                        <div class="col pb-20 mb-30"> <a class="btn button-primary slide-button" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a></div>
                        <?php endif;?>
                    </div>

                </div>


                <div class="col-lg-7 col-sm-12 d-flex justify-content-center right-banner-image">
                    <div class="color-overlay"></div>
                    <ul class="anim-slider">
                        <!-- Slide No1 -->
                        <?php if( have_rows('slider_settings') ): ?>
                        <?php while( have_rows('slider_settings') ): the_row(); ?>
                        <li class="anim-slide">
                            <?php $right_image = get_sub_field('right_image');  ?>
                            <img src="<?php echo $right_image['url'];?>" alt="<?php echo $right_image['alt']; ?>" >
                        </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="trustPilotSlider mt-20 desktophide" style="display: block;width: 100%; background: #fff;">
                    <!-- TrustBox widget - Micro Review Count -->
                    <div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="59d644180000ff0005ace17e" data-style-height="24px" data-style-width="100%" data-theme="light" style="position: relative;"><iframe style="position: relative; height: 24px; width: 100%; border-style: none; display: block; overflow: hidden;" title="Customer reviews powered by Trustpilot" src="https://widget.trustpilot.com/trustboxes/5419b6a8b0d04a076446a9ad/index.html?templateId=5419b6a8b0d04a076446a9ad&amp;businessunitId=59d644180000ff0005ace17e#locale=en-GB&amp;styleHeight=24px&amp;styleWidth=100%25&amp;theme=light"></iframe></div>
                    <!-- End TrustBox widget -->
                </div>

            </div>

        </div>
    </div>

</section>
