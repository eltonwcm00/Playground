<?php
namespace ElementsKit;

use ElementsKit\Export\Export_Screen;
use ElementsKit\Import\Import_Screen;

defined( 'ABSPATH' ) || exit;


/**
 * ElementsKit - the God class.
 * Initiate all necessary classes, hooks, configs.
 *
 * @since 1.1.0
 */
class Plugin{


	/**
	 * The plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Handler
	 */
    public static $instance = null;

    /**
     * Construct the plugin object.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        // Call the method for ElementsKit autoloader.
        $this->registrar_autoloader();

        Hooks\Register_Modules::instance();
        Hooks\Register_Widgets::instance();

        Libs\Framework\Attr::instance();

        new Widgets\Init\Enqueue_Scripts();

        // Register updater module
        new Libs\Updater\Init();

        Export_Screen::instance()->init();
		Import_Screen::instance()->init();

        // Register license module
        $license = Libs\Framework\Classes\License::instance(); 

          
    }


    /**
     * Autoloader.
     *
     * ElementsKit autoloader loads all the classes needed to run the plugin.
     *
     * @since 1.0.0
     * @access private
     */
    private function registrar_autoloader() {
        require_once \ElementsKit::plugin_dir() . '/autoloader.php';
        Autoloader::run();
    }


    /**
     * Instance.
     *
     * Ensures only one instance of the plugin class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return Handler An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire when ElementsKit instance.
            self::$instance = new self();

            // Fire when ElementsKit was fully loaded and instantiated.
            do_action( 'elementskit/loaded' );
        }

        return self::$instance;
    }
}

// Run the instance.
Plugin::instance();