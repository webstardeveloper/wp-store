<?php
/*******************************************************************************
 * Plugin Name: Import Woocommerce
 * Description: Import your WordPress Post, Page and Simple WooCommerce Product with Import Woocommerce.
 * Version: 1.5
 * Text Domain: import-woocommerce
 * Domain Path: /languages
 * Author: smackcoders
 * Author URI: https://www.smackcoders.com
 */

/*******************************************************************************
 * Import Woocommerce is a Tool for importing CSV for the Wordpress
 * plugin developed by Smackcoders. Copyright (C) 2017 Smackcoders.
 *
 * Import Woocommerce is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License version 3
 * as published by the Free Software Foundation with the addition of the
 * following permission added to Section 15 as permitted in Section 7(a): FOR
 * ANY PART OF THE COVERED WORK IN WHICH THE COPYRIGHT IS OWNED BY Import Woocommerce, 
   Import Woocommerce DISCLAIMS THE WARRANTY OF NON
 * INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * Import Woocommerce is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public
 * License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program; if not, see http://www.gnu.org/licenses or write
 * to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA 02110-1301 USA.
 *
 * You can contact Smackcoders at email address info@smackcoders.com.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * Import Woocommerce copyright notice. If the display of the logo is
 * not reasonably feasible for technical reasons, the Appropriate Legal
 * Notices must display the words
 * "Copyright Smackcoders. 2017. All rights reserved".
 ********************************************************************************/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! class_exists( 'WooComSmCSVHandler' ) ) :
	/**
	 * Main WPUltimateCSVImporter Class.
	 *
	 * @class WPUltimateCSVImporter Class
	 * @version     5.0
	 */
	class WooComSmCSVHandler {

		public $version = '1.5';

		/**
		 * The single instance of the class.
		 *
		 * @var $_instance
		 * @since 5.0
		 */
		protected static $_instance = null;

		/**
		 * Main WPUltimateCSVImporter Instance.
		 *
		 * Ensures only one instance of WPUltimateCSVImporter is loaded or can be loaded.
		 *
		 * @since 5.0
		 * @static
		 * @see WC()
		 * @return WooComSmCSVHandler - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * WooComSmCSVHandler Constructor.
		 */
		public function __construct() {
			include_once ( 'includes/class-uci-install.php' );
			//include_once ( 'uninstall.php' );

			do_action( 'wp_ultimate_csv_importer_loaded' );
			add_filter( 'plugin_row_meta', array('SmUCIWcomInstall', 'plugin_row_meta'), 10, 2 );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),  array('SmUCIWcomInstall', 'plugin_row_meta'), 10, 2 );			

			if ( ! function_exists( 'is_plugin_active' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
		}

		/**
		 * Hook into actions and filters.
		 * @since  5.0
		 */
		private function init_hooks() {
			//register_activation_hook( __FILE__, array( 'SmUCIWcomInstall', 'install' ) );
			add_action( 'plugins_loaded', array( $this, 'init' ), 0 );

			function admin_notice_importwcom() {
				global $pagenow;
				$active_plugins = get_option( "active_plugins" );
			    if ( $pagenow == 'plugins.php' && !in_array('wp-ultimate-csv-importer/index.php', $active_plugins) ) {
				    ?>
				    <div class="notice notice-warning is-dismissible" >
				        <p> Import Woocommerce is an addon of <a href="https://goo.gl/fwqMnZ" target="blank" style="cursor: pointer;text-decoration:none">WP Ultimate CSV Importer</a> plugin, kindly install it to continue using import woocommerce. </p>
				        <p>
				    </div>
				    <?php 
			   }
			}
        

		add_action( 'admin_notices', 'admin_notice_importwcom' );
		}

		/**
		 * Define SmUCIWcom Constants.
		 */
		public function define_constants() {
			$upload_dir = wp_upload_dir();
			$this->define( 'SM_UCIWCOM_PLUGIN_FILE', __FILE__ );
			$this->define( 'SM_UCIWCOM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'SM_UCIWCOM_VERSION', $this->version );
			$this->define( 'SM_UCIWCOM_DELIMITER', ',' );
			$this->define( 'SM_UCIWCOM_PRO_DIR', plugin_dir_path(__FILE__));
			$this->define( 'SM_UCIWCOM_PRO_URL', plugins_url().'/import-woocommerce');
			$this->define( 'SM_UCIWCOM_LOG_DIR', $upload_dir['basedir'] . '/smack_uci_uploads/import_logs/' );
			$this->define( 'SM_UCIWCOM_DEFAULT_UPLOADS_DIR', $upload_dir['basedir'] );
			$this->define( 'SM_UCIWCOM_DEFAULT_UPLOADS_URL', $upload_dir['baseurl'] );
			$this->define( 'SM_UCIWCOM_FILE_MANAGING_DIR', $upload_dir['basedir'] . '/smack_uci_uploads/' );
			$this->define( 'SM_UCIWCOM_IMPORT_DIR', $upload_dir['basedir'] . '/smack_uci_uploads/imports' );
			$this->define( 'SM_UCIWCOM_IMPORT_URL', $upload_dir['baseurl'] . '/smack_uci_uploads/imports' );
			$this->define( 'SM_UCIWCOM_EXPORT_DIR', $upload_dir['basedir'] . '/smack_uci_uploads/exports/' );
			$this->define( 'SM_UCIWCOM_EXPORT_URL', $upload_dir['baseurl'] . '/smack_uci_uploads/exports/' );
			$this->define( 'SM_UCIWCOM_ZIP_FILES_DIR', $upload_dir['basedir'] . '/smack_uci_uploads/zip_files/' );
			$this->define( 'SM_UCIWCOM_INLINE_IMAGE_DIR', $upload_dir['basedir'] . '/smack_inline_images/' );
			$this->define( 'SM_UCIWCOM_SCREENS_DATA',$upload_dir['basedir'].'/smack_uci_uploads/screens_data');
			$this->define( 'SM_UCIWCOM_SESSION_CACHE_GROUP', 'smack_uci_session_id' );
			$this->define( 'SM_UCIWCOM_SETTINGS', 'user-importer-free' );
			$this->define( 'SM_UCIWCOM_NAME', 'Import Woocommerce' );
			$this->define( 'SM_UCIWCOM_SLUG', 'import-woocommerce' );
			$this->define( 'SM_UCIWCOM_DEBUG_LOG', $upload_dir['basedir'] . '/import-woocommerce.log');
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param  string $name
		 * @param  string|bool $value
		 */
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		public function includes() {
			include_once ( 'includes/class-uci-helper.php' );
			include_once ( 'admin/class-uci-admin.php' );
		}


		/**
		 * Init WooComSmCSVHandlerPro when WordPress Initialises.
		 */
		public function init() {
			if(is_admin()) :
				// Init action.
				do_action( 'uci_init' );
				if(is_admin()) {
					#$this->includes();
					//SmUCIWcomAdminAjax::smuci_ajax_events();
					# Removed: De-Register the media sizes
				}
			endif;
		}

		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Get Ajax URL.
		 * @return string
		 */
		public function ajax_url() {
			return admin_url( 'admin-ajax.php', 'relative' );
		}

		/**
		 * Email Class.
		 * @return SM_UCIWCOM_Emails
		 */
		public function mailer() {
			return SM_UCIWCOM_Emails::instance();
		}
	}
endif;


/**
 * Main instance of WPUltimateCSVImporterPro.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  5.0
 * @return WPUltimateCSVImporterPro
 */
function SmUCIWcom() {
	return WooComSmCSVHandler::instance();
}
// Global for backwards compatibility.
$GLOBALS['wp_ultimate_csv_importer'] = SmUCIWcom();