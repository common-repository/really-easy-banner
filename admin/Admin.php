<?php

namespace UnikForce\REB\Admin;

/**
 * Class Admin
 * @package UnikForce\UnikForce\Admin
 */
class Admin
{
    function __construct()
    {
        //add_filter('plugin_action_links_' . REB_PLUGIN_BASE, [$this, 'plugins_setting_links']);
        //add_filter('plugin_row_meta', array($this, 'plugin_meta_links'), 10, 2);
        add_filter('admin_footer_text', [$this, 'admin_footer_text']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    /**
     * Admin css Handler
     */
    public function enqueue_assets()
    {
        wp_register_style('reb-admin', REB_PL_URL . 'admin/assets/css/main.css', '', REB_VERSION, 'all');
        wp_register_script('reb-admin', REB_PL_URL . 'admin/assets/js/main.js', ['jquery'], REB_VERSION, true);

        wp_enqueue_script('reb-admin');
        wp_enqueue_style('reb-admin');
    }

    /**
     * [plugins_setting_links]
     * @param  [array] $links default plugin action link
     * @return [array] plugin action link
     */
    public function plugins_setting_links($links)
    {
        $settings_link = '<a href="' . admin_url('admin.php?page=unikforce') . '">' . esc_html__('Settings', 'really-easy-banner') . '</a>';
        array_unshift($links, $settings_link);
        if (!is_plugin_active('really-easy-banner-pro/really-easy-banner-pro.php')) {
            $links['really-easy-banner'] = sprintf('<a href="https://unikforce.com" target="_blank" style="color: #39b54a; font-weight: bold;">' . esc_html__('Go Pro', 'really-easy-banner') . '</a>');
        }
        return $links;
    }

    /**
     * Add links to plugin's description in plugins table
     *
     * @param array $links Initial list of links.
     * @param string $file Basename of current plugin.
     *
     * @return array
     */
    function plugin_meta_links($links, $file)
    {
        if (strpos($file, basename(__FILE__))) {
            return $links;
        }

        $links[] = '<a target="_blank" href="https://wordpress.org/support/plugin/really-easy-banner" title="' . __('Get help', 'really-easy-banner') . '">' . __('Support', 'really-easy-banner') . '</a>';
        $links[] = '<a target="_blank" href="https://wordpress.org/support/plugin/really-easy-banner/reviews/#new-post" title="' . __('Rate the plugin', 'really-easy-banner') . '">' . __('Rate the plugin ★★★★★', 'really-easy-banner') . '</a>';

        return $links;
    }

    /**
     * Add powered by text in admin footer
     *
     * @param string $text Default footer text.
     *
     * @return string
     */
    function admin_footer_text($text)
    {
        if (!$this->is_plugin_page()) {
            return $text;
        }

        $text = '<i><a href="' . esc_url($this->generate_web_link('admin_footer')) . '" title="' . esc_attr(__('Visit UnikForce Elementor WooCommerce  page for more info', 'really-easy-banner')) . '" target="_blank">UnikForce Elementor WooCommerce </a> v' . REB_VERSION . '. Please <a target="_blank" href="https://wordpress.org/support/plugin/unikforce-addons/reviews/#new-post" title="Rate the plugin">rate the plugin <span>★★★★★</span></a> to help us spread the word. Thank you from the WP Reset team!</i>';

        return $text;
    } // is_plugin_page

    /**
     * Test if we're on unikforce's admin page
     *
     * @return bool
     */
    function is_plugin_page()
    {
        $current_screen = get_current_screen();

        if (!empty($current_screen->id) && $current_screen->id == 'plugins') {
            return true;
        } else {
            return false;
        }
    } // generate_web_link

    /**
     * Helper function for generating links
     *
     * @param string $placement Optional. UTM content param.
     * @param string $page Optional. Page to link to.
     * @param array $params Optional. Extra URL params.
     * @param string $anchor Optional. URL anchor part.
     *
     * @return string
     */
    function generate_web_link($placement = '', $page = '/', $params = array(), $anchor = '')
    {
        $base_url = 'https://unikforce.com';

        if ('/' != $page) {
            $page = '/' . trim($page, '/') . '/';
        }
        if ($page == '//') {
            $page = '/';
        }

        if ($placement) {
            $placement = trim($placement);
            $placement = '-' . $placement;
        }

        $parts = array_merge(array('ref' => 'wp-reset-free' . $placement), $params);

        if (!empty($anchor)) {
            $anchor = '#' . trim($anchor, '#');
        }

        $out = $base_url . $page . '?' . http_build_query($parts, '', '&amp;') . $anchor;

        return $out;
    } // admin_footer_text


}