<?php
/**
 * Shortcodes
 *
 * @package     Donately
 * @subpackage  Shortcodes
 * @copyright   Copyright (c) 2013, Fifty and Fifty
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


function dntly_donation_form( $atts ) 
{
    global $post, $dntly_settings;
    
    // print '<pre>';
    // print_r( $dntly_settings );
    // print '</pre>';

    extract( shortcode_atts( array(
            'campaign_id'    => '',
            'show_address'   => false,
            'show_phone'     => false,
            'show_comments'  => false,
            'show_onbehalf'  => false,
            'show_anonymous' => false,
            'amount'         => 0,
            'width'          => '',
            'height'         => ''
        ),
        $atts, 'donately_form' )
    );

    // Set $show_address
    if( isset( $dntly_settings['donately_address'] ) && false == $show_address ) {
        
        $show_address = $dntly_settings['donately_address'];

    }elseif( true == $show_address ){
        
        $show_address = $show_address;
    }


    // Set $show_phone
    if( isset( $dntly_settings['donately_phone'] ) && false == $show_phone ) {
        
        $show_phone = $dntly_settings['donately_phone'];

    }elseif( true == $show_phone ){
        $show_phone = $show_phone;
    }


    // Set $show_comments
    if( isset( $dntly_settings['donately_comment'] ) && false == $show_comments ) {
        
        $show_comments = $dntly_settings['donately_comment'];

    }elseif( isset( $show_comments ) ){
        
        $show_comments = $show_comments;
        
    }

    // Set $show_onbehalf
    if( isset( $dntly_settings['donately_onbehalf'] ) && false == $show_onbehalf ) {
        
        $show_onbehalf = $dntly_settings['donately_onbehalf'];

    }elseif( true == $show_onbehalf ){
        
        $show_onbehalf = $show_onbehalf;
    }


    // Set $amount
    if( isset( $dntly_settings['donately_amount'] ) && $amount != 0 ) {
        
        $amount = $amount;
    
    }else{
        
        $amount = $dntly_settings['donately_amount'];
    }


    // Set $width
    if( isset( $dntly_settings['donately_width'] ) && false == $width ) {
        $width = $dntly_settings['donately_width'];

    }elseif( true == $width ){
        $width = $width;
    }


    // Set $height
    if( isset( $dntly_settings['donately_height'] ) && false == $height ) {
        $height = $dntly_settings['donately_height'];

    }elseif( true == $height ){
        $height = $height;
    }



    $donately_args = array(
        'show_address'   => $show_address,
        'show_phone'     => $show_phone,
        'show_comments'  => $show_comments,
        'show_onbehalf'  => $show_onbehalf,
        'show_anonymous' => $show_anonymous,
        'amount'         => $amount,
        'width'          => $width,
        'height'         => $height
    );

    echo donately_form( $donately_args );
    
}
add_shortcode( 'donately_form', 'dntly_donation_form' );



function dntly_render_button_shortcode( $atts )
{
    global $post, $dntly_settings;
    
    extract( shortcode_atts( array(
            'campaign_id' => null,
            'class'       => 'button',
            'amount'      => null,
            'text'        => null
        ),
        $atts, 'donately_button' )
    );

    //$cid = isset( $campaign_id ) ? $campaign_id : $post->ID;
    
    $btn_text = isset( $text ) ? $text : $dntly_settings['donation_button_text'];
    $cid      = isset( $campaign_id ) ? $campaign_id : $post->ID;

    ob_start();

    $args = array(
        'campaign_id' => $cid,
        'class'       => $class,
        'text'        => $btn_text,
        'amount'      => $amount
    );

    dntly_donate_link( $args );
    
    return ob_get_clean();
}
add_shortcode( 'donately_button', 'dntly_render_button_shortcode' );