<?php

function reb_get_option($option = '', $default = null)
{
    $options = get_option('_really_easy_banner'); // Attention: Set your unique id of the framework
    return (isset($options[$option])) ? $options[$option] : $default;
}

function reb_image_generator(){

}