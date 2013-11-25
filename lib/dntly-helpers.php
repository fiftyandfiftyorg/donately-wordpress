<?php 

class DNTLY_FIELDS {

  private $dntly_data;
  private $dntly_camp_id;
  private $dntly_account_id;
  private $dntly_environment;

  function __construct() {
    // set locale for currenct conversion
    setlocale(LC_MONETARY, 'en_US');

    // needed for $post->ID
    global $post;

    // dntly fields
    $this->dntly_data         = get_post_meta($post->ID, '_dntly_data', true);
    $this->dntly_camp_id      = get_post_meta($post->ID, '_dntly_id', true);
    $this->dntly_campaign_id  = get_post_meta($post->ID, '_dntly_campaign_id', true);
    $this->dntly_account_id   = get_post_meta($post->ID, '_dntly_account_id', true);
    $this->dntly_environment  = get_post_meta($post->ID, '_dntly_environment', true);
  }
  


  /**
   * DNTLY Data
   *
   * @since 0.1
   * @package Donately Wordpress
   * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
   * @return [array] '_dntly_data' post meta
   */
  function dntly_data( $args = NULL )
  {
    return $this->dntly_data;
  }


  /**
     * DNTLY Environment
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return [array] '_dntly_environment' post meta
     */
  function dntly_environment( $args = NULL )
  {
    return $this->dntly_environment;
  }



  /**
     * DNTLY Account ID
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return [array] '_dntly_account_id' post meta
     */
  function dntly_account_id( $args = NULL )
  {
    return $this->dntly_account_id;
  }

  /**
     * DNTLY Account Title
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return (string) 'account_title' option value
     */
  function dntly_account_title( $args = NULL )
  {
    if ( isset($this->dntly_data['account_title']) ) {
      $account_title = $this->dntly_data['account_title'];
    } else {
      $account_title = null;
    }
    return $account_title;
  }

  /**
     * DNTLY Campaign ID
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return [array] '_dntly_campaign_id' post meta
     */
  function dntly_campaign_id( $args = NULL )
  {
    return $this->dntly_camp_id;
  }



  /**
     * DNTLY Campaign Goal
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return (int) $campaign_goal || (string) formatted USD $campaign_goal
     */
  function dntly_campaign_goal( $args = NULL )
  {      
    // Parameters
    $format   = isset($args['format']) ? $args['format'] : null;
    $locale   = isset($args['locale']) ? $args['locale'] : 'en_US';
    $currency = isset($args['currency']) ? $args['currency'] : '%i';

    // If 'campaign_goal' is set, set $campaign_goal as it's intval, else return 0
    if ( isset($this->dntly_data['campaign_goal']) ) {
      // if it is set and not NULL, get campaign goal integar.
      $campaign_goal = intval($this->dntly_data['campaign_goal']);
    } else {
      // otherwise set it to zero.
      $campaign_goal = intval(0);
    }

    // If format parameter is passed
    if ( $format ) {
      // Set locale
      setlocale(LC_MONETARY, $locale);
      // Format to USD
      $campaign_goal_formatted = money_format($currency, $campaign_goal);
      // Return the formatted goal integer
      return $campaign_goal_formatted;
    } else {
      // Return unformatted goal integer
      return $campaign_goal;
    }
  }





  /**
     * DNTLY Donations Count
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return (string) 'donations_count'
     */
  function dntly_donations_count( $args = NULL )
  {     
    // If it is set and not NULL, get campaign goal integar.
    if ( isset($this->dntly_data['donations_count']) ) {
      $donations_count = intval($this->dntly_data['donations_count']);
    } 
    // Otherwise set it to zero.
    else {
      $donations_count = intval(0);
    }
    return $donations_count;
  }






  /**
     * DNTLY Donors Count
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return (int) $donors_count
     */
  function dntly_donors_count( $args = NULL )
  {      
    // If it is set and not NULL, get campaign goal integar.
    if ( isset($this->dntly_data['donors_count']) ) {
      $donors_count = intval($this->dntly_data['donors_count']);
    } 
    // Otherwise set it to zero.
    else {
      $donors_count = intval(0);
    }
    return $donors_count;
  }


  /**
     * DNTLY Amount Raised
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return (int) $amount_raised
     */
  function dntly_amount_raised( $args = NULL ) {

    // !! See dntly_campaign_goal for comments !!

    $format   = isset($args['format']) ? $args['format'] : null;
    $locale   = isset($args['locale']) ? $args['locale'] : 'en_US';
    $currency = isset($args['currency']) ? $args['currency'] : '%i';  

    if ( isset($this->dntly_data['amount_raised']) ) {
      $amount_raised = intval($this->dntly_data['amount_raised']);
    } else {
      $amount_raised = intval(0);
    }

    if ( $format ) {
      setlocale(LC_MONETARY, $locale);
      $amount_raised_formatted = money_format($currency, $amount_raised);
      return $amount_raised_formatted;
    } else {
      return $amount_raised;
    }

  }

  /**
     * DNTLY Percentage Raised
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return (int) $percentage_raised
     */
  function dntly_percentage_raised( $args = NULL ) {

    // Vars
    $campaign_goal = $this->dntly_campaign_goal();
    $amount_raised = $this->dntly_amount_raised();
 
    if ( $campaign_goal ) {
      $percentage_raised = number_format( $amount_raised / $campaign_goal * 100 );
    } else {
      $percentage_raised = intval(0);
    }

    return $percentage_raised;
  }

 




  /**
     * DNTLY Meta General
     *
     * @since 0.1
     * @package Donately Wordpress
     * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
     * @return [array]
     */
  function dntly_meta_general() {

    if ( isset($post) && is_object($post) && isset($post->ID) && !empty($post->ID)) {
      $meta_general = get_post_meta($post->ID, '_meta_general', true);
    } else {
      $meta_general = null;
    }
    return $meta_general;
  }


}










/* ============================================================= */
/*                      Wordpress Functions                      */
/* ============================================================= */

add_action('init', 'dntly_helper_functions');

function dntly_helper_functions()
{

  /* ACCOUNT ID
  ================================================== */
  function get_the_account_id()
  {
    $df = new Dntly_fields;
    return $df->dntly_account_id;
  }
  function dntly_account_id()
  {
    echo get_the_account_id();
  }

  /* ACCOUNT TITLE
  ================================================== */
  function get_the_account_title()
  {
    $df = new Dntly_fields;
    return $df->dntly_account_title;
  }
  function account_title()
  {
    echo get_the_account_title();
  }

  /* CAMPAIGN & FUNDRAISER ('parent') ID
  ================================================== */
  function get_the_campaign_id( $scope = NULL ) {
    $df = new Dntly_Fields;

    if ( isset($scope) && $scope == 'parent') {
      return $df->dntly_parent_campaign_id();
    } else {
      return $df->dntly_campaign_id();
    }
  }
  function campaign_id( $scope = NULL ){
    if ( isset($scope) && $scope == 'parent') {
      echo get_the_campaign_id('parent');
    } else {
      echo get_the_campaign_id();
    }
    
  }
  /* CAMPAIGN GOAL
  ================================================== */
  function get_the_campaign_goal()
  {
    $df = new Dntly_Fields;
    return $df->dntly_campaign_goal();
  }
  function campaign_goal()
  {

    $campaign_goal      = get_the_campaign_goal();
    $campaign_goal_usd  = number_format( $campaign_goal );

    echo '$'.$campaign_goal_usd;
  }

  /* FUNDRAISER ID
  ================================================== */
  function get_the_fundraiser_id()
  {
    return get_the_campaign_id();
  }
  function fundraiser_id()
  {
    echo campaign_id();
  }


  /* FUNDRAISER GOAL
  ================================================== */
  function get_the_fundraiser_goal()
  {
    $df = new Dntly_Fields;
    return $df->dntly_fundraiser_goal();
  }
  function fundraiser_goal()
  {

    $fundraiser_goal      = get_the_fundraiser_goal();
    $fundraiser_goal_usd  = number_format( $fundraiser_goal );

    echo '$'.$fundraiser_goal_usd;
  }

  /* DONATION COUNT
  ================================================== */
  function get_the_donations_count()
  {
    $df = new Dntly_Fields;
    return $df->dntly_donations_count();
  }
  function donations_count()
  {
    echo get_the_donations_count();
  }

  /* DONORS COUNT
  ================================================== */
  function get_the_donors_count()
  {
    $df = new Dntly_Fields;
    return $df->dntly_donors_count();
  }
  function donors_count()
  {
    echo get_the_donors_count();
  }

  /* AMOUNT RAISED
  ================================================== */
  function get_the_amount_raised()
  {
    $df = new Dntly_Fields;
    return $df->dntly_amount_raised();
  }
  function amount_raised( $format = NULL ){
    if ( isset($format) && $format == 'usd' ) {
      $amount_raised      = get_the_amount_raised();
      $amount_raised_usd  = money_format('%.2n', $amount_raised);
      echo $amount_raised_usd;
    } else {
      echo get_the_amount_raised();
    }
  }

  /* CAMPAIGN PERCENTAGE RAISED
  ================================================== */
  function get_the_percentage_raised()
  {
    $df = new Dntly_Fields;
    return $df->dntly_percentage_raised();
  }
  function percentage_raised($type = NULL){
    echo get_the_percentage_raised();
  }

  /* FUNDRAISER PERCENTAGE RAISED
  ================================================== */
  function get_the_fundraiser_percentage_raised()
  {
    $df = new Dntly_Fields;
    return $df->dntly_fundraiser_percentage_raised();
  }
  function fundraiser_percentage_raised()
  {
    echo get_the_fundraiser_percentage_raised();
  }

  /* META GENERAL
  ================================================== */
  function get_the_meta_general()
  {
    $df = new Dntly_fields;
    return $df->dntly_meta_general();
  }
  function meta_general()
  {
    echo get_the_meta_general();
  }

  /* TRACKING CODES
  ================================================== */
  function get_the_tracking_codes()
  {
    $df = new Dntly_fields;
    return $df->dntly_tracking_codes();
  }
  function dntly_tracking_codes()
  {
    echo get_the_tracking_codes();
  }

  
}
