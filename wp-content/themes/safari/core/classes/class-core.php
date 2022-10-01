<?php
/**
 * Core class.
 *
 * @package Wordpress
 * @subpackage Safari_Theme
 */

namespace Yz\Safari;

use Error;
use stdClass;
use WP_Error;

/**
 * Core class implementation.
 */
final class Core {


	/**
	 * Base path for classes within package.
	 *
	 * @var string
	 */
	public static $classes_base_path;

	/**
	 * Core class instance (singleton).
	 *
	 * @var Core
	 */
	protected static $instance = null;

	/**
	 * Project config.
	 *
	 * @var array
	 */
	protected $config = [];

	/**
	 * Classes registry.
	 *
	 * @var array
	 */
	protected $registry = [];

	/**
	 * Data storage.
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Hooks namespace prefix.
	 *
	 * @var string
	 */
	protected $hooks_namespace;

	/**
	 * Base theme URI.
	 *
	 * @var string
	 */
	public static $theme_base_uri;

	/**
	 * Constructor. Initializes class autoloading.
	 */
	private function __construct() {
		$this->hooks_namespace = strtolower( str_replace( '\\', '/', __NAMESPACE__ ) );

		self::$classes_base_path = rtrim( dirname( __FILE__ ), '/\\' );
		self::$theme_base_uri = get_stylesheet_directory_uri();
		spl_autoload_register( __CLASS__ . '::autoload' );
	}

	/**
	 * Process configuration JSON file.
	 *
	 * @param  string $config Filename path.
	 * @param  array  $domain Section key under which to put preocessed configuration.
	 * @return Core   Class instance.
	 */
	public function configure( $config, $domain = null ) {
		if ( ! file_exists( $config ) ) {
			return $this->instance;
		}
		$config_data = json_decode( file_get_contents( $config ), true );

		if ( ! is_array( $config_data ) ) {
			return $this->instance;
		}

		foreach ( $config_data as $name => $config ) {
			$section = $name;
			if ( $domain ) {
				$handle_section = $domain . '/' . $section;
			}
			do_action( $this->get_hooks_ns() . '/config/' . $section, $config );
		}

		return $this->instance;
	}

	/**
	 * Get class instance. Ensure there can be only one.
	 *
	 * @return Core
	 */
	public static function instance() : Core {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Autoload handler.
	 *
	 * @param  string $class_name - name of the class to load.
	 * @throws Error  If can't load class.
	 * @return void
	 */
	public static function autoload( $class_name ) {
		if ( 0 !== strpos( $class_name, __NAMESPACE__ ) ) {
			return;
		}

		$class_name = str_replace( __NAMESPACE__ . '\\', '', $class_name );
		$class = explode( '\\', $class_name );

		$not_found = true;
		$class_file = str_replace( '_', '-', strtolower( array_pop( $class ) ) ) . '.php';
		$class_path = implode( DIRECTORY_SEPARATOR, $class );
		if ( ! empty( $class_path ) ) {
			$class_path .= DIRECTORY_SEPARATOR;
		}
		foreach ( [ 'trait', 'interface', 'class' ] as $type ) {
			$file_location = self::$classes_base_path . DIRECTORY_SEPARATOR . $class_path . "$type-$class_file";
			if ( file_exists( $file_location ) ) {
				require_once $file_location;
				$not_found = false;
			}
		}

		if ( $not_found ) {
			throw new Error( sprintf( "\n\n\nCould not load %s from %s.\n\n\n", $class_name, self::$classes_base_path ) );
		}

	}

	/**
	 * Get prefix namespace for used hooks.
	 *
	 * @return string
	 */
	public function get_hooks_ns() {
		return $this->hooks_namespace;
	}

	/**
	 * Returns depending on scope a class from registry or config section.
	 * Searched by name. If no name provided resturns entire registry/config array.
	 *
	 * @param  string|null $name   The name of the class or config section to search for.
	 * @param  string|null $scope  The name of the scope. Either a 'registry' or 'config'.
	 * @param  boolean     $strict Wether to throw an exception if not found.
	 * @return mixed
	 * @throws Error       If not found and strict mode is true.
	 */
	public function fetch( ?string $name = null, ?string $scope = null, bool $strict = true ) {
		if ( ! $scope ) {
			$scope = 'registry';
		}

		if ( ! in_array( $scope, [ 'registry', 'config' ] ) ) {

			if ( ! $strict ) {
				return flase;
			}
			throw new Error( sprintf( 'Invalid scope: %s', $scope ) );
		}

		if ( null === $name ) {
			return $this->{$scope};
		}

		if ( ! key_exists( $name, $this->{$scope} ) ) {
			if ( $strict ) {
				throw new Error( sprintf( 'Instance of "%s" not found in $s', $name, $scope ) );
			}

			return null;
		}
		return $this->{$scope}[ $name ];
	}

	/**
	 * Put value into class registry or config storage.
	 *
	 * @param  string $name Name of the variable.
	 * @param  mixed  $value Value of the variable.
	 * @param  string $scope Where to put. Either 'registry' or 'config'.
	 * @return Core   Class instance.
	 * @throws Error  Invalid scope exception.
	 */
	public function put( string $name, $value, ?string $scope = null ) {
		if ( ! $scope ) {
			$scope = 'registry';
		}

		if ( ! in_array( $scope, [ 'registry', 'config' ] ) ) {

			if ( ! $strict ) {
				return flase;
			}
			throw new Error( sprintf( 'Invalid scope: %s', $scope ) );
		}

		$this->{$scope}[ $name ] = $value;

		return $this->instance;
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {}

	/**
	 * Unserializing instance is forbidden.
	 */
	public function __wakeup() {}
}
