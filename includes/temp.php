<?php

/**
 * Plugin Name:       Paulund Plugin Welcome Page
 * Plugin URI:        https://paulund.co.uk
 * Description:       Plugin to demo how to create a pmprobp page for your plugin
 * Version:           1.0
 * Author:            Paulund
 * Author URI:        https://paulund.co.uk
 * Text Domain:       paulund
 */


new PMPro_Add_On_Welcome();
/**
 * Paulund plugin pmprobp
 */
class PMPro_Add_On_Welcome {

	/**
	 * Add the min caps used for the plugin
	 */
	const min_caps = 'manage_options';

	/**
	 * PMPro_Add_On_Welcome constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'create_admin_menus' ) );
		add_action( 'admin_init', array( $this, 'pmprobp' ), 11 );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
	}

	/**
	 * Add the page to the admin area
	 */
	public function create_admin_menus() {
		add_dashboard_page(
			'PMPro BP page',
			'PMPro BP page',
			self::min_caps,
			'pmprobp-page.php',
			array( $this, 'pmprobp_message' )
		);

		// Remove the page from the menu
		remove_submenu_page( 'index.php', 'pmprobp-page.php' );
	}

	/**
	 * Display the plugin pmprobp message
	 */
	public function pmprobp_message() {
		?>

		<
div
id
="plugin-header"
>

			<img class="plugin-logo" src="logo-url.png" alt="Plugin logo" / >

			<
h1
>
Welcome to the plugin
</
h1
>


			<
p
class
="about-text"
>

				Thank you for downloading the plugin, I hope you enjoy the features it brings to your WordPress site.

			</
p
>


		</
div
>

		<?php
	}

	/**
	 * Check the plugin activated transient exists if does then redirect
	 */
	public function pmprobp() {
		if ( ! get_transient( 'pmprobp_activated' ) ) {
			return;
		}

		// Delete the plugin activated transient
		delete_transient( 'pmprobp_activated' );

		wp_safe_redirect(
			add_query_arg(
				array(
					'page' => 'pmprobp-page.php',
				), admin_url( 'index.php' )
			)
		);
		exit;
	}

	/**
	 *
	 */
	public function admin_head() {
		// Add custom styling to your page
	}
}
