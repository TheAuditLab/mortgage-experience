<section class="d-flex align-items-center animatedDiv">
<div class="formCTA" id="request-a-callback">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 formIntro">
                <div class="d-flex flex-row pt-10">
                    <div class="px-3">    <h3><?php the_field('heading'); ?></h3></div>
                </div>
                <?php if( get_field('sub_text') ) { ?>
                    <p class="pb-3"><?php the_field('sub_text'); ?></p>
                <?php } ?>
            </div>

            <div class="col-lg-7 col-sm-12 form_rightImage d-flex align-items-end">
                <?php
                $form = get_field( 'choose_form' );
                if ( class_exists( 'Ninja_Forms' ) ) {
                    Ninja_Forms()->display( $form[ 'id' ] );
                }
                ?>
            </div>
        </div>
    </div>
</div>
</section>
