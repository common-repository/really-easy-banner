<?php
$bg = reb_get_option('background_img');
$main_heading = reb_get_option('main_heading');
$button_link = reb_get_option('button_link');
$button_text = reb_get_option('button_text');
?>
<section class="reb-1" data-background="<?php echo esc_url($bg['url']);?>">
    <div class="reb-container">
        <div class="reb-row justify-content-center">
            <div class="reb-col-9">
                <h3 class="reb-text">
                    <?php echo esc_html($main_heading);?> <a href="<?php echo esc_url($button_link['url']);?>" class="reb-link"><?php echo esc_html($button_text);?></a>
                </h3>
            </div>
        </div>
    </div>
</section>