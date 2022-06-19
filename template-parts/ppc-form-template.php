<?php /* Template Name: PPC Form Template*/ ?> 

<style>
    #ppcFormBody{
        background-color: #473b5e;
    }

    #ppcFormBody h1{ 
        color: #ffffff;
        padding-top: 50px; 
        padding-bottom: 20px;  
    } 

    #ppcFormBody{
        color: #ffffff;
    }

    #ppcFormBody .ninja-forms-req-symbol{
        display: none;
    }

    #ppcFormBody .nf-response-msg{
        margin: 25px 10px;
        padding: 15px 35px 10px 35px;
        background: #ffffff;
    }

    #ppcFormBody .nf-response-msg p{
        color: #413B5E!important;
    }

    @media (max-width: 1024px){
        #ppcFormBody .nf-form-cont{
            margin-top: -50px;
        }

        #ppcFormBody .nf-response-msg{
            margin: 50px 10px;
        }
    }

    .how-it-works{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    @media (max-width: 1024px){
        .how-it-works{
            padding-top: 40px;
        }

        .how-it-works .stepCircles{
            display: inline-flex;
            margin: 0 auto!important;
        }

        .how-it-works .stepCircles .circle{
            margin: 0 0.5em!important;
        }
    }

    @media (max-width: 767px){
        .how-it-works .stepCircles{
            display: block;
        }
        .how-it-works .stepCircles .circle{
            margin: 20px auto!important;
        } 
        .first-step .wrapper .mobile-left-image img{
            display: none;
        }
    }

    .first-step img{
        width: 75%;
    }

    @media (max-width: 1199px){
        .first-step img{
            width: 100%;
        }
    }

    .tabbedcontentblock .tabimageone{
        position: relative;
    }

    .tabbedcontentblock .tabimageone img {
        top: -80px!important;
        left: -80px;
    }

    #ppcFAQ{
        padding-top: 120px;
        padding-bottom: 40px;
        background-color: #fafafa;
    }

    @media (max-width: 1024px){
        .tabbedcontentblock .tabsImage img{
            width: 45%;
            top: -38%!important;
        }
    }

    @media (max-width: 768px){
        #ppcFAQ{
            padding-top: 60px;
        } 
    }
</style>

<?php
    $ppc_page_title = get_field("ppc_page_title");
    $ppc_intro_paragraph = get_field("ppc_intro_paragraph");
?>

<?php get_header(); ?>

<section id="ppcFormBody">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h1><?php echo $ppc_page_title ?></h1>
           
                <?php echo $ppc_intro_paragraph ?>

                <br>
            </div>

            <div class="col-12 col-lg-5 offset-lg-1">
                <?php echo do_shortcode("[ninja_form id=10]"); ?>
            </div>
        </div>
    </div>
</section>

<?php 
    include "blocks/advisers-how-it-works-block.php"; 
?>

<br><br>

<?php 
    include "blocks/first-step-block.php"; 
?>

<?php 
    include "blocks/advisers-tabs-block.php"; 
?>

<section id="ppcFAQ">
    <div class="container">
        <?php the_content(); ?>
    </div>
</section>

<?php get_footer(); ?>