
<section class="page-banner">

    <?php if ( get_field( 'full_width_banner_image' ) ): ?>

    <?php
    $full_width_banner_image = get_field('full_width_banner_image');
    if( !empty($full_width_banner_image) ): ?>

    <div class="banner-wrapper full-width-banner" style="background-image: url(<?php echo $full_width_banner_image['url']; ?>);">
        <div class="container">
            <div class="color-overlay"></div>
        <?php endif; ?>

    <?php else: // field_name returned false ?>

        <div class="banner-wrapper">
            <div class="container">
    <?php endif; // end of if field_name logic ?>

        <div class="row ">

<?php
            $left_image_location = get_field( "left_image_location" ); // add field name here for certifications
            $left_image = get_field( "left_image" ); // add field name here for bio

?>

           <?php
       //    echo "<pre style=\"text-align:left;padding:10px;border:1px solid red;background-color:#fff;color:#111;font-family:Courier;\">";
       //     print_r( get_field( 'left_image_location' ) );
       //     echo "</pre>";
       //     ?>



            <?php
            switch($left_image_location) {
              case (get_field('left_image_location') == 'under-heading'):?>

                  <div class="col-lg-5 col-sm-12 left-banner-image-right d-flex flex-column <?php the_field('left_image_location'); ?>">
                      <h1 class="h3"><?php the_field('heading'); ?></h1>

                         <?php
                      $left_image = get_field('left_image');
                      $show_left_image = get_field('show_left_image');
                      if( !empty($left_image) && ($show_left_image || $show_left_image === null) ): ?>
                          <img src="<?php echo $left_image['url']; ?>" alt="<?php echo $left_image['alt']; ?>" />
                      <?php endif; ?>

                      <?php the_field('banner_text'); ?>
                      <?php if( get_field('trustpilot_html') ): ?>
                          <div class="pagebannerTrustpilot"> <?php the_field('trustpilot_html'); ?></div>
                      <?php endif; ?>

                      <div class="d-flex flex-row mobilehide">
                          <?php if( have_rows('button') ): ?>
                              <?php while( have_rows('button') ): the_row(); ?>
                          <?php
                          $link = get_sub_field('button_link');
                          if( $link ):
                              $link_url = $link['url'];
                              ?>
                                  <div class="col pb-20"> <a class="btn button-primary slide-button" href="<?php echo esc_url($link_url); ?>"> <?php the_sub_field('button_text'); ?></a></div>
                          <?php endif; ?>
                              <?php endwhile; ?>
                          <?php endif;?>

                      </div>

                      <div class="d-flex flex-column desktophide">
                          <?php if( have_rows('button') ): ?>
                              <?php while( have_rows('button') ): the_row(); ?>
                          <?php
                          $link = get_sub_field('button_link');
                          if( $link ):
                              $link_url = $link['url'];
                              ?>
                              <div class="col pb-20"> <a class="btn button-primary slide-button" href="<?php echo esc_url($link_url); ?>"> <?php the_sub_field('button_text'); ?></a></div>
                          <?php endif; ?>
                              <?php endwhile; ?>
                          <?php endif;?>

                      </div>

                  </div> <!-- If true it will show image to right of heading -->

                    <?php   break; ?>
                <?php  case(get_field('left_image_location') == 'left-of-heading'):?>

                <div class="col-lg-5 col-sm-12 left-banner-image-right d-flex flex-column <?php the_field('left_image_location'); ?>">

                    <div class="d-flex flex-row">

                        <?php
                        $left_image = get_field('left_image');
                        if( !empty($left_image) ): ?>
                            <img src="<?php echo $left_image['url']; ?>" alt="ME" style="max-width:10rem;padding-right:5px;"/>
                        <?php endif; ?>

                        <h1 class="h3"><?php the_field('heading'); ?></h1>

                    </div>

                 <?php the_field('banner_text'); ?>

                    <?php if( get_field('trustpilot_html') ): ?>
                    <div class="pagebannerTrustpilot"> <?php the_field('trustpilot_html'); ?></div>
                    <?php endif; ?>



                    <div class="d-flex flex-row mobilehide">
                        <?php if( have_rows('button') ): ?>
                            <?php while( have_rows('button') ): the_row(); ?>
                        <?php
                        $link = get_sub_field('button_link');
                        if( $link ):
                            $link_url = $link['url'];
                            ?>
                            <div class="col pb-20"> <a class="btn button-primary slide-button" href="<?php echo esc_url($link_url); ?>"> <?php the_sub_field('button_text'); ?></a></div>
                        <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif;?>

                    </div>

                    <div class="d-flex flex-column desktophide">
                        <?php if( have_rows('button') ): ?>
                            <?php while( have_rows('button') ): the_row(); ?>
                                <?php
                                $link = get_sub_field('button_link');
                                if( $link ):
                                    $link_url = $link['url'];
                                    ?>
                                    <div class="col pb-20"> <a class="btn button-primary slide-button" href="<?php echo esc_url($link_url); ?>"> <?php the_sub_field('button_text'); ?></a></div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif;?>

                    </div>

                </div> <!-- If true it will show image to left of heading -->


                <?php break; ?>


            <?php case(get_field('left_image_location') == 'right-of-heading'): ?>

                <div class="col-lg-5 col-sm-12 left-banner-image-right d-flex flex-column <?php the_field('left_image_location'); ?>">

                    <div class="d-flex flex-row">
                        <div class="pr-2">  <h1 class="h3"><?php the_field('heading'); ?></h1></div>
                        <div class="p-2">
                            <?php
                            $left_image = get_field('left_image');
                            if( !empty($left_image) ): ?>
                                <img src="<?php echo $left_image['url']; ?>" alt="ME" />
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php the_field('banner_text'); ?>
                    <?php if( get_field('trustpilot_html') ): ?>
                        <div class="pagebannerTrustpilot"> <?php the_field('trustpilot_html'); ?></div>
                    <?php endif; ?>

                    <div class="d-flex flex-row mobilehide">
                        <?php if( have_rows('button') ): ?>
                            <?php while( have_rows('button') ): the_row(); ?>
                        <?php
                        $link = get_sub_field('button_link');
                        if( $link ):
                            $link_url = $link['url'];
                            ?>
                            <div class="col pb-20"> <a class="btn button-primary slide-button" href="<?php echo esc_url($link_url); ?>"> <?php the_sub_field('button_text'); ?></a></div>
                        <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif;?>

                    </div>

                    <div class="d-flex flex-column desktophide">
                        <?php if( have_rows('button') ): ?>
                            <?php while( have_rows('button') ): the_row(); ?>
                        <?php
                        $link = get_sub_field('button_link');
                        if( $link ):
                            $link_url = $link['url'];
                            ?>
                            <div class="col pb-20"> <a class="btn button-primary slide-button" href="<?php echo esc_url($link_url); ?>"> <?php the_sub_field('button_text'); ?></a></div>
                        <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif;?>

                    </div>

                </div> <!-- If true it will show image to under heading -->


            <?php
            }
            ?>



            <?php if ( get_field( 'right_image' ) ): ?>

                <div class="col-lg-7 col-sm-12 d-flex justify-content-center right-banner-image">
                    <div class="color-overlay"></div>
                    <?php $right_image = get_field('right_image');  ?>
                    <img src="<?php echo $right_image['url'];?>" />
                </div> <!--This is displayed when right_image is TRUE or has a value.-->

            <?php else: // field_name returned false ?>

                <!--This is displayed when the field is FALSE, NULL or the field does not exist.-->

            <?php endif; // end of if field_name logic ?>





        </div>

        </div>
     </div>

</section>