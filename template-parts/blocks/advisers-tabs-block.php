

<section class="tabbedcontentblock advisersTabs animatedDiv data-aos_fade-up  data-aos-delay_100 data-aos-duration_400">
    <div class="container">
        <div class="tabbgimage"></div>
        <div class="tabsImage tabimageone align-self-baseline">
            <?php $tab_image = get_field('tab_image');  ?>
            <img class="mobilehide" src="<?php echo $tab_image['url'];?>" />
        </div>
        <div class="tabsImage tabimagetwo align-self-baseline">
            <?php $second_tab_image = get_field('second_tab_image');  ?>
            <img class="mobilehide" src="<?php echo $second_tab_image['url'];?>" />
        </div>

        <?php
      echo '<div class="tabs tabs_default tabs_active">';

            echo'<ul class="horizontal">';
            if( have_rows('tabs') ):
            $i = 1;
            while ( have_rows('tabs' ) ) : the_row();

                echo '<li class="tabmobile"><a class="tab' . $i . '" href="#tab-' . $i . '">' . get_sub_field( "tab_link" ) . '</a></li>';
                $i++;
            endwhile;
            echo '</ul>';
              $i = 1;

               while ( have_rows('tabs') ) : the_row();
                   echo '<div class="tab-content" id="tab-' . $i . '">' . get_sub_field( "tab_content" ) . '</div>';
                   $i++;
                   endwhile;
                echo '</div>';
            else :

             endif;
            ?>
</div>

    <div class="arrow-down mobilehide"></div>
</section>




