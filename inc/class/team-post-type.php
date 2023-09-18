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
		      'label'   => 'Jury',
		      'show_ui'   => true,
		      'supports'  => array('title','editor','thumbnail','page-attributes'),
		      'menu_icon' => 'dashicons-groups',
		      'labels'  => array (
		              'name'      			=> 'Jurados',
		              'singular_name' 		=> 'Jurado',
		              'add_new_item'   		=> 'Add New Jury Member',
		              'edit_item'   		=> 'Edit Jury Member',
		              'add_new'   			=> 'Add New Jury Member',
		              'view_item'   		=> 'View Jury Member',
		              'search_items'   		=> 'Search Jury Member',
		              'not_found'   		=> 'No Jury Member Found',
		              'not_found_in_trash'	=> 'No Jury Member Found',
		              'all_items'			=> 'All Jury Members',
		              'archives'			=> 'Jury Member Archives',
		              'menu_name'   		=> 'Jury',
		      ),
		  ) 
		);
	}

}

new TeamPostType();