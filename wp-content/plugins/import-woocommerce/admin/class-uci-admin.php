<?php

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

include_once ( plugin_dir_path(__FILE__) . '../includes/class-uci-helper.php' );

class SmUCIWcomAdmin extends SmUCIWcomHelper {


	public function getMetaFieldsOfWcom()
	{
		$MetaFields = array(
				'Product Shipping Class' => 'product_shipping_class',
				'Visibility' => 'visibility',
				'Tax Status' => 'tax_status',
				'Product Type' => 'product_type',
				'Product Attribute Name' => 'product_attribute_name',
				'Product Attribute Value' => 'product_attribute_value',
				'Product Attribute Visible' => 'product_attribute_visible',
				'Product Attribute Variation' => 'product_attribute_variation',
				'Product Attribute Position' => 'product_attribute_position',
				'Featured Product' => 'featured_product',
				'Product Attribute Taxonomy' => 'product_attribute_taxonomy',
				'Tax Class' => 'tax_class',
				'File Paths' => 'file_paths',
				'Edit Last' => 'edit_last',
				'Edit Lock' => 'edit_lock',
				'Thumbnail Id' => 'thumbnail_id',
				// 'Visibility' => 'visibility',
				'Stock Status' => 'stock_status',
				'Stock Quantity' => 'stock_qty',
				'Total Sales' => 'total_sales',
				'Downloadable' => 'downloadable',
				'Virtual' => 'virtual',
				'Regular Price' => 'regular_price',
				'Sale Price' => 'sale_price',
				'Purchase Note' => 'purchase_note',
				'Weight' => 'weight',
				'Length' => 'length',
				'Width' => 'width',
				'Height' => 'height',
				'SKU' => 'sku',
				'UpSells Id' => 'upsell_ids',
				'CrossSells Id' => 'crosssell_ids',
				'Sales Price Date From' => 'sale_price_dates_from',
				'Sales Price Date To' => 'sale_price_dates_to',
				'Price' => 'price',
				'Sold Individually' => 'sold_individually',
				'Manage Stock' => 'manage_stock',
				'Backorders' => 'backorders',
				'Stock' => 'stock',
				'Product Image Gallery' => 'product_image_gallery',
				'Product URL' => 'product_url',
				'Button Text' => 'button_text',
				'Downloadable Files' => 'downloadable_files',
				'Download Limit' => 'download_limit',
				'Download Expiry' => 'download_expiry',
				'Download Type' => 'download_type',
				/* 'Min Variation Price' => 'min_variation_price',
				'Max Variation Price' => 'max_variation_price',
				'Min Price Variation Id' => 'min_price_variation_id',
				'Max Price Variation Id' => 'max_price_variation_id',
				'Min Variation Regular Price' => 'min_variation_regular_price',
				'Max Variation Regular Price' => 'max_variation_regular_price',
				'Min Regular Price Variation Id' => 'min_regular_price_variation_id',
				'Max Regular Price Variation Id' => 'max_regular_price_variation_id',
				'Min Variation Sale Price' => 'min_variation_sale_price',
				'Max Variation Sale Price' => 'max_variation_sale_price',
				'Min Sale Price Variation Id' => 'min_sale_price_variation_id',
				'Max Sale Price Variation Id' => 'max_sale_price_variation_id', */
				'Default Attributes' => 'default_attributes',
			);
		return $MetaFields;
	}

	public function getWoocomDataHtml($template_mapping)
	{
		 require_once ('views/form-woocommerce-meta.php');
         woocommerce_meta_api($template_mapping);
	}

}
//add_action('init', array('SmUCIWcomAdmin', 'show_admin_menus'));
global $wcomUci_admin;
$wcomUci_admin = new SmUCIWcomAdmin();
