<?php 
/**
* 
*/
class TeamPostType
{
	
	function __construct()
	{
		add_action( 'init', array($this,'create_team' ));
	}

	public function create_team() {
		register_post_type('team', 
		  array(
		      'label'   => 'Team',
		      'show_ui'   => true,
		      'supports'  => array('title','editor','thumbnail','page-attributes'),
		      'menu_icon' => 'dashicons-groups',
		      'labels'  => array (
		              'name'      			=> 'Teams',
		              'singular_name' 		=> 'Team',
		              'add_new_item'   		=> 'Add New Team Member',
		              'edit_item'   		=> 'Edit Team Member',
		              'add_new'   			=> 'Add New Team Member',
		              'view_item'   		=> 'View Team Member',
		              'search_items'   		=> 'Search Team Member',
		              'not_found'   		=> 'No Team Member Found',
		              'not_found_in_trash'	=> 'No Team Member Found',
		              'all_items'			=> 'All Team Members',
		              'archives'			=> 'Team Member Archives',
		              'menu_name'   		=> 'Team',
		      ),
		  ) 
		);
	}

}

new TeamPostType();