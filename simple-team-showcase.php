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

define( 'TEAM_PATH', plugin_dir_path( __FILE__ ) );
add_action('init', 'create_team');
function create_team(){
    register_post_type('team', array(
        'label' => 'Team',
        'show_ui' => true,
        'support' => array('title', 'editor', 'thumbnail', 'page-attibutes'),
        'labels' => array(
            'name' => 'Teams',
            'singular_name' => 'Team',
            'menu_name' => 'Teams'
        ),
        ));
}

function add_team_member_metabox(){
    add_meta_box(
      'team_member_meta',
      'Member Information',
      'team_member_meta_callback',
      'team',
        'advanced',
        'high'
    );
  }
  add_action('add_meta_boxes','add_team_member_metabox');

  function team_member_meta_callback($post) { 
    wp_nonce_field( basename(__FILE__), 'team_member_nonce');    
    $routine_store_meta=get_post_meta($post->ID);

    $short_bio=(get_post_meta($post->ID,'short_bio',true)) ? get_post_meta($post->ID,'short_bio',true) : '';
    $member_designation=(get_post_meta($post->ID,'member_designation',true)) ? get_post_meta($post->ID,'member_designation',true) : '';
    $member_email=(get_post_meta($post->ID,'member_email',true)) ? get_post_meta($post->ID,'member_email',true) : '';
    $member_website=(get_post_meta($post->ID,'member_website',true)) ? get_post_meta($post->ID,'member_website',true) : '';
    $member_phone=(get_post_meta($post->ID,'member_phone',true)) ? get_post_meta($post->ID,'member_phone',true) : '';
    $member_location=(get_post_meta($post->ID,'member_location',true)) ? get_post_meta($post->ID,'member_location',true) : '';

    $member_facebook=(get_post_meta($post->ID,'member_facebook',true)) ? get_post_meta($post->ID,'member_facebook',true) : '';
    $member_twitter=(get_post_meta($post->ID,'member_twitter',true)) ? get_post_meta($post->ID,'member_twitter',true) : '';
    $member_linkedin=(get_post_meta($post->ID,'member_linkedin',true)) ? get_post_meta($post->ID,'member_linkedin',true) : '';
    $member_youtube=(get_post_meta($post->ID,'member_youtube',true)) ? get_post_meta($post->ID,'member_youtube',true) : '';

    ?>
    <div class="bootstrap-wrapper">
      <div class="row" style="margin:0px">
        <div class="form-horizontal"> 
          <div class="form-group">       
            <label for="short_bio" class="control-label col-xs-2">Short Bio</label>
            <div class="col-xs-10">
              <textarea rows="5" class="form-control" type="text" id="short_bio" name="short_bio" placeholder="Member short bio" required ><?php echo $short_bio; ?></textarea>
            </div>
          </div> 
          <div class="form-group">       
            <label for="member_designation" class="control-label col-xs-2">Designation</label>
            <div class="col-xs-10">
              <input class="form-control" type="text" id="member_designation" name="member_designation" placeholder="Designation" value="<?php echo $member_designation; ?>" required />
            </div>
          </div>         
          <div class="form-group">       
            <label for="member_email" class="control-label col-xs-2">Email </label>
            <div class="col-xs-10">
              <input class="form-control" type="email" id="member_email" name="member_email" placeholder="member Email" value="<?php echo $member_email; ?>"  />
            </div>
          </div>
          <div class="form-group">       
            <label for="member_website" class="control-label col-xs-2">Personal Web URL </label>
            <div class="col-xs-10">
              <input class="form-control" type="url" id="member_website" name="member_website" placeholder="member Website" value="<?php echo $member_website; ?>"  />
            </div>
          </div>
          <div class="form-group">       
            <label for="member_phone" class="control-label col-xs-2">Telephone </label>
            <div class="col-xs-10">
              <input class="form-control" type="phone" id="member_phone" name="member_phone" placeholder="member Phone" value="<?php echo $member_phone; ?>"  />
            </div>
          </div>
          <div class="form-group">       
            <label for="member_location" class="control-label col-xs-2">Location </label>
            <div class="col-xs-10">
              <input class="form-control" type="text" id="member_location" name="member_location" placeholder="member Location" value="<?php echo $member_location; ?>"  />
            </div>
          </div>
        </div>        
      </div>
      <div class="row" style="margin:0px">
        <h2 class="hndle ui-sortable-handle">Social Links</h2>
        <div class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label for="member_facebook" class="control-label col-xs-2">Facebook</label>
                    <div class="col-xs-10">
                        <input type="url" class="form-control" id="member_facebook" name="member_facebook" value="<?php echo $member_facebook; ?>" placeholder="Facebook">
                    </div>
                </div>
                <div class="form-group">
                    <label for="member_twitter" class="control-label col-xs-2">Twitter</label>
                    <div class="col-xs-10">
                        <input type="url" class="form-control" id="member_twitter" name="member_twitter" value="<?php echo $member_twitter; ?>" placeholder="Twitter">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="member_linkedin" class="control-label col-xs-2">LinkedIn</label>
                    <div class="col-xs-10">
                        <input type="url" class="form-control" id="member_linkedin" name="member_linkedin" value="<?php echo $member_linkedin; ?>" placeholder="LinkedIn">
                    </div>
                </div>
                <div class="form-group">
                    <label for="member_youtube" class="control-label col-xs-2">Youtube</label>
                    <div class="col-xs-10">
                        <input type="url" class="form-control" id="member_youtube" name="member_youtube" value="<?php echo $member_youtube; ?>" placeholder="Youtube">
                    </div>
                </div>
            </fieldset> 
        </div>
      </div>     
    </div>
    <?php
 
} // end wp_custom_attachment

function team_member_meta_save($post_id){
    $is_autosave      = wp_is_post_autosave($post_id);
    $is_revision      = wp_is_post_revision($post_id);
  
    $is_valid_nonce   = (isset($_POST['sm_member_nonce']) && wp_verify_nonce($_POST['sm_member_nonce'], basename(__FILE__)))? 'true' : 'false';
  
    if($is_autosave || $is_revision || !$is_valid_nonce){
      return;
    }
    // member Personal Information and Image
    // if(isset($_POST['member_image'])){
    //   // update_post_meta($post_id,'member_image',($_POST['member_image']));
    //   update_post_meta($post_id,'member_image',sanitize_text_field($_POST['member_image']));
    // }
    if(isset($_POST['short_bio'])){
      update_post_meta($post_id,'short_bio',sanitize_text_field($_POST['short_bio']));
    }
    if(isset($_POST['member_designation'])){
      update_post_meta($post_id,'member_designation',sanitize_text_field($_POST['member_designation']));
    }      
    if(isset($_POST['member_email'])){
      update_post_meta($post_id,'member_email',sanitize_email($_POST['member_email']));
    }
    if(isset($_POST['member_website'])){
      update_post_meta($post_id,'member_website',sanitize_text_field($_POST['member_website']));
    }
    if(isset($_POST['member_phone'])){
      update_post_meta($post_id,'member_phone',sanitize_text_field($_POST['member_phone']));
    }
    if(isset($_POST['member_location'])){
      update_post_meta($post_id,'member_location',sanitize_text_field($_POST['member_location']));
    }
  
     // member Social Network  
    
    if(isset($_POST['member_facebook'])){
      update_post_meta($post_id,'member_facebook',sanitize_text_field($_POST['member_facebook']));
    }
    if(isset($_POST['member_twitter'])){
      update_post_meta($post_id,'member_twitter',sanitize_text_field($_POST['member_twitter']));
    }
    if(isset($_POST['member_linkedin'])){
      update_post_meta($post_id,'member_linkedin',sanitize_text_field($_POST['member_linkedin']));
    }
    if(isset($_POST['member_youtube'])){
      update_post_meta($post_id,'member_youtube',sanitize_text_field($_POST['member_youtube']));
    }
  }
  
  add_action('save_post','team_member_meta_save');

  function team_custom_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'featured_image' => 'Image',
        'member_designation' => 'Designation',
        'member_email' => 'Email',
        'date' => 'Date'
     );
    return $columns;
}
add_filter('manage_posts_columns' , 'team_custom_columns');

// Register the column as sortable
function register_team_sortable_columns( $columns ) {
    $columns['member_designation'] = 'member_designation';

    return $columns;
}
add_filter( 'manage_posts_columns_sortable_columns', 'register_team_sortable_columns' );


function team_custom_columns_data( $column, $post_id ) {
    switch ( $column ) {
      case 'featured_image':
          echo the_post_thumbnail( array(40,40) );
          break;
        case 'member_designation':
      $member_designation = get_post_meta( $post_id, 'member_designation', true );
      echo $member_designation;
      break;
    case 'member_email':
      $member_email = get_post_meta( $post_id, 'member_email', true );
      echo $member_email;
      break;
    }
}
add_action( 'manage_posts_custom_column' , 'team_custom_columns_data', 10, 2 ); 

require(TEAM_PATH.'inc/team-shortcode.php');