<?php 
/*
Plugin Name: Simple team showcase
Plugin URI:https://wordpress.org/plugins/sm-team/
Author: Jorge Arteaga
Author URI:http://jlarteaga.com
Description: A wordpress plugin for manage and display team member list.
Version:1.1.0
*/

// Simple data from plugin
class Team {
    function __construct(){
        define( 'TEAM_PATH', plugin_dir_path( __FILE__ ) );
        define( 'TEAM_URL', plugin_dir_url( __FILE__ ));
    

    require(TEAM_PATH.'inc/class/team-post-type.php'); 
    require(TEAM_PATH.'inc/class/team-post-meta.php');
    require(TEAM_PATH.'inc/team-settings.php'); 
    require(TEAM_PATH.'inc/team-shortcode.php');

    add_action( 'admin_enqueue_scripts', array($this,'team_scripts_enqueue' ));
}

public function team_scripts_enqueue(){
    do_action('team_action_scripts_enqueue');
}
}
new Team();