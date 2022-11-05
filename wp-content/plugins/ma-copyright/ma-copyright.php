<?php
/*
Plugin Name: MA Copyright
Plugin URI: http://ma-emotion.ru/
Description: Copyright plugin
Author: toaster16mb
Author URI: http://ma-emotion.ru/
Version: 1.1
*/

add_action('wp_head', 'ma_wp_head');
function ma_wp_head() {
    echo '<meta name="cmsmagazine" content="f019251de429bf5c4fee0887923f6388" />';
}
add_action('wp_footer', 'ma_wp_footer');
function ma_wp_footer() {
    echo '<a style="color: #000; opacity: .5; display: block; padding: 5px;" href="http://ma-emotion.ru/" title="Создание сайтов">E-motion</a>';
}