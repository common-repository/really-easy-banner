<?php

namespace UnikForce\REB\Frontend;

class Frontend
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_head', [$this, 'select_layout']);
    }

    public function enqueue_assets(){
        wp_register_style('reb-frontend', REB_DIR_URL.'frontend/assets/css/main.css', '', REB_VERSION, 'all');
        wp_register_script('reb-frontend', REB_DIR_URL.'frontend/assets/js/main.js', ['jquery'], REB_VERSION, true);

        wp_enqueue_script('reb-frontend');
        wp_enqueue_style('reb-frontend');
    }

    public function select_layout(){
       $layout = reb_get_option('banner_layout', 'layout1');
       include_once REB_PLUGIN_DIR_NAME . 'frontend/layout/'.$layout.'.php';
    }
}