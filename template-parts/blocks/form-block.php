<section class="bg-<?php the_field('background_color'); ?> d-flex align-items-center  animatedDiv data-aos_fade-up  data-aos-delay_100 data-aos-duration_400">
    <div class="formCTA">
        <div class="container">
            <div class="row">
         <div class="col-lg-6 col-sm-12">
             <div class="d-flex flex-row pt-50">
                 <div>    <h3><?php the_field('formblock_heading'); ?></h3></div>
                 <div class="p-2 me_image">  <img src="/wp-content/uploads/2021/09/ME-Logo-Master-Vertical-Stack-White-RGB@2x.png" alt="ME" /></div>
             </div>
             <?php if( get_field('formblock_text') ) { ?>
                 <p class="pb-3"><?php the_field('formblock_text'); ?></p>
             <?php } ?>


             <?php
             $form = get_field( 'select_form' );
             if ( class_exists( 'Ninja_Forms' ) ) {
                 Ninja_Forms()->display( $form[ 'id' ] );
             }
             ?>
         </div>

                <div class="col-lg-6 col-sm-12 form_rightImage d-flex align-items-end">
                    <?php $formblock_right_image = get_field('formblock_right_image');  ?>
                    <img src="<?php echo $formblock_right_image['url'];?>" />
                </div>
            </div>
        </div>
    </div>
</section>


