<?php

/**
 * Plugin Name:       ** My Plugin
 * Description:       Handle the basics with this plugin.
 * Plugin URI:        https://mourad.com/plugins/the-basics/
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mourad EL CADI
 * Author URI:        https://mourad.elcadi.com/
 * License:           GPL v2 or later
 * License URI:       https://www.mourad.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */


add_action('woocommerce_cart_calculate_fees', function(){
    global $woocommerce;

    $woocommerce->cart->add_fee(__('Packaging fees', 'woocommerce'), 5);
});