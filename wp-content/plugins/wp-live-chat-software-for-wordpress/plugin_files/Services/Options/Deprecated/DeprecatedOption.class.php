<?php
/**
 * Class DeprecatedOption
 *
 * @package LiveChat\Services\Options\Deprecated
 */

namespace LiveChat\Services\Options\Deprecated;

use LiveChat\Services\Options\ReadableOption;

/**
 * Class DeprecatedOption
 *
 * @package LiveChat\Services\Options\Deprecated
 */
class DeprecatedOption extends ReadableOption {
	/**
	 * DeprecatedOption constructor.
	 *
	 * @param string $wp_key  WordPress deprecated option key.
	 * @param string $woo_key WooCommerce deprecated option key.
	 */
	public function __construct( $wp_key, $woo_key = null ) {
		if ( ! $woo_key ) {
			$woo_key = $wp_key;
		}

		parent::__construct(
			is_woo() ? $woo_key : $wp_key,
			null,
			DEPRECATED_OPTION_PREFIXES[ is_woo() ? 'woo-legacy' : 'wp-legacy' ]
		);
	}
}
