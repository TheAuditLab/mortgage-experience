<?php if (have_rows('circle_block')): ?>
    <div class="container-fluid">
        <?php
        $className = 'hideondesktop';
        if (!empty($block['className'])) {
            $className .= ' ' . $block['className'];
        }
        ?>

        <div class="row <?php echo esc_attr($className); ?>">
            <?php while (have_rows('circle_block')): the_row(); ?>
                <?php
                $link = get_sub_field('button');
                $image = get_sub_field('image');
                if (!empty($image)): ?>
                    <div class="col d-flex flex-column align-items-center circle-blocks animatedDiv data-aos_fade-up data-aos-delay_100 data-aos-duration_400">

                        <img class="circular--square" alt="<?= $link ? esc_html($link['title']) : '' ?>" src="<?php echo $image['url']; ?>"/>


                <?php endif; ?>
                <?php if (get_sub_field('heading')): ?>
                    <h4 class="mobilehide"> <?php echo wp_kses(get_sub_field('heading'), array('br' => array())); ?></h4>
                <?php endif; ?>
                <?php if (get_sub_field('text')): ?>
                    <p class="mobilehide"> <?php echo wp_kses(get_sub_field('text'), array('br' => array())); ?></p>
                <?php endif; ?>

                <?php
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <span class="circle-button">
                            <a class="btn bg-<?php the_sub_field('button_color'); ?>"
                               href="<?php echo esc_url($link_url); ?>"
                               target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        </span>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>

    </div>
<?php endif; ?>

