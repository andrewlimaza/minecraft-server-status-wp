<?php

/*
Plugin Name: Minecraft Status WP
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Andrew Lima
Author URI: http://URI_Of_The_Plugin_Author
License: GPL 2.0 Higher
*/

/**
* 
*/

use MinecraftServerStatus\MinecraftServerStatus;

class Easy_Minecraft_Server_Status_WP{
  
	private static $instance = null;

	 /**
     * Creates or returns an instance of this class.
     *
     * @return  PMPro_Approvals A single instance of this class.
     */
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

	/**
	* Constructor
	* Initializes the plugin by setting localization, filters, and administration functions.
	*/
    private function __construct() {		

  		add_action( 'init', array( $this, 'init' ) );	
      add_shortcode( 'test_shortcode', array( $this, 'test_shortcode' ) );

    }

    /**
    * Initialize Plugin.
    * All hooks that are required for the plugin to run immediately will be listed in here.
    */
    public static function init(){

    }

    public function test_shortcode(){

      require '/includes/vendor/autoload.php';

      $response = MinecraftServerStatus::query('lostforce.com', 25565);

      if (! $response) {
          return "The Server is offline!";
      } else {
          return "<img width=\"64\" height=\"64\" src=\"" . $response['favicon'] . "\" /> <br>
          The Server " . $response['hostname'] . " is running on " . $response['version'] . " and is online,
          currently are " . $response['players'] . " players online
          of a maximum of " . $response['max_players'] . ". The motd of the server is '" . $response['description'] . "'.
          The server has a ping of " . $response['ping'] . " milliseconds.";
      }


      
    }


} // class end

Easy_Minecraft_Server_Status_WP::get_instance();