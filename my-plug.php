<?php

/**
 * Plugin Name:       My Basics Plugin
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



add_filter('woocommerce_checkout_fields', function($fields){

    unset($fields['billing']['billing_address_2']);

    return $fields;
});


add_action('woocommerce_before_order_notes', function($checkout){

    $saved_passport_num = wp_get_current_user()->passport_num;

    woocommerce_form_field('passport_num', array(

        'type'          =>  'text',
        'class'         =>  array(),
        'label'         =>  'Passport Number',
        'placeholder'   =>  'ex: s4g9z4rg9e4g',
        'required'      =>  true,
        'default'       =>  $saved_passport_num,

    ), $checkout->get_value('passport_num'));

});


add_action('woocommerce_checkout_process', function () {
    // Check if set, if its not set add an error.
    if ( ! $_POST['passport_num'] ){
        wc_add_notice( __( 'Please add passport number' ), 'error' );
    }
});


/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', function ( $order_id ) {

    if ( ! empty( $_POST['passport_num'] ) ) {
        update_post_meta( $order_id, '_passport_num', sanitize_text_field( $_POST['passport_num'] ) );
    }

});


add_action('woocommerce_admin_order_data_after_shipping_address', function($order){

    $data = get_post_meta($order->get_id(), '_passport_num', true);

    if(!empty($data)){

        echo '<p><strong>' . __('passport number', 'woocommerce') . ': </strong><span>' . $data . '</span></p>';

    }

});


add_action('woocommerce_email_after_order_table', function(){

    $data = get_post_meta($order->get_id(), '_passport_num', true);

    if(!empty($data)){

        echo '<p><strong>' . __('passport number', 'woocommerce') . ': </strong><span>' . $data . '</span></p>';

    }

});