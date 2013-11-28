<?php
/**
 * Donate Button Functions
 *
 * @package     Donately
 * @subpackage  Functions/Templates
 * @copyright   Copyright (c) 2013, Bryan Monzon
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Get Donate Link
 *
 * Builds a URL to create a dynamic donation link based on the campaign ID.
 * @param  [type] $campaign_id [description]
 * @return [type]              [description]
 */
function dntly_donate_link( $args = array() ) {
    global $dntly_settings, $post;

    $defaults = apply_filters( 'dntly_donation_link_defaults', array(
        'campaign_id' => $post->ID,
        'text'        => !empty( $dntly_settings[ 'donation_button_text' ] ) ? $dntly_settings[ 'donation_button_text' ] : __( 'Donation', 'dntly' ),
        'class'       => 'button'
    ) );

    $args = wp_parse_args( $args, $defaults );


    if( 'publish' != get_post_field( 'post_status', $args['campaign_id'] ) && ! current_user_can( 'edit_pages', $args['campaign_id'] ) ) {
        return false; // Product not published or user doesn't have permission to view drafts
    }

    //  ob_start(); 
?>
    <style>
    .donation_button_wrapper a.button{
        background: #3279A0;
        color: #fff;
        padding: 10px 20px;
        border-radius: 3px;
        font-size: 1.3em;
        font-family:helvetica, arial, sans-serif;
    }

    .donation_button_wrapper a.button:hover{
        background: #126FA0;
        text-decoration: none;
    }
    </style>
    <div class="donation_button_wrapper">
        <?php 
        printf(
        '<a href="%2$s" class="%3$s">%4$s</a>',
        implode( ' ', array( trim( $args['class'] ), $args['text'] ) ),
        esc_url( dntly_get_donation_page_uri() . '?cid=' . $post->ID ),
        esc_attr( $args['class'] ),
        esc_attr( $args['text'] )
        )
        ?>
    </div>
<?php
    //$donation_button = ob_clean();

    return apply_filters( 'dntly_donately_button', $args );
}

