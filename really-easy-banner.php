<?php
/**
 * Plugin Name: Really Easy Banner
 * Description: Really easy banner is for showing the wp banner.
 * Plugin URI:  https://wordpress.org/plugins/really-easy-banner/
 * Version:     1.0.0
 * Author:      UnikForce IT
 * Author URI:  https://really-easy-banner.com/
 * License:     GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: really-easy-banner
 * WC tested up to: 5.5.2
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Autoloader File
require_once (__DIR__ . '/vendor/autoload.php');
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

/**
 * Class REB
 */
final class REB
{
    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /** Singleton *************************************************************/

    private function __construct()
    {

        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Main UnikForce Instance
     *
     * Insures that only one instance of UnikForce exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     */

    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * @return mixed
     */
    public function define_constants()
    {
        define('REB_VERSION', self::VERSION);
        define('REB_PL_ROOT', __FILE__);
        define('REB_PL_URL', plugins_url('/', REB_PL_ROOT));
        define('REB_PL_PATH', plugin_dir_path(REB_PL_ROOT));
        define('REB_DIR_URL', plugin_dir_url(REB_PL_ROOT));
        define('REB_PLUGIN_BASE', plugin_basename(REB_PL_ROOT));
        define('REB_PLUGIN_DIR_NAME', dirname(__FILE__) . '/');
        define('REB_ITEM_NAME', 'Really Easy Banner');
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {

        if(is_admin()){
            new UnikForce\REB\Admin\Admin();
        }
        new UnikForce\REB\Frontend\Frontend();

    }

    /**
     * Activate Log to database
     */
    public function activate()
    {

        $installed = get_option('really_easy_banner_installed');

        if (!$installed) {
            update_option('really_easy_banner_installed', time());
        }

        update_option('really_easy_banner_version', REB_VERSION);
    }

    /**
     * Throw error on object clone
     *
     * The whole idea of the singleton design pattern is that there is a single
     * object therefore, we don't want the object to be cloned.
     */
    public function __clone()
    {
        // Cloning instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, __('Cheating&#8217; huh?', 'really-easy-banner'), '1.0.0');
    }

    /**
     * Disable unserializing of the class
     *
     */
    public function __wakeup()
    {
        // Unserializing instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, __('Cheating&#8217; huh?', 'really-easy-banner'), '1.0.0');
    }

}

function REB_INIT()
{
    return REB::init();
}

// Get UnikForce Elementor WooCommerce  Running
REB_INIT();