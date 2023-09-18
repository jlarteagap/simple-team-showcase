<?php 
/**
* 
*/
class TeamPostMeta
{
	
	function __construct()
	{
		add_action('add_meta_boxes',array($this,'add_team_member_metabox'));
		add_action('save_post',array($this,'team_member_meta_save'));
		add_filter('manage_posts_columns' , array($this,'team_custom_columns'));
		add_filter( 'manage_posts_columns_sortable_columns', array($this,'register_team_sortable_columns' ));
		add_action( 'manage_posts_custom_column' , array($this,'team_custom_columns_data'), 10, 2 ); 
	}


	public function add_team_member_metabox(){
	  	add_meta_box(
	    	'team_member_meta',
	    	'Member Information',
	    	array($this,'team_member_meta_callback'),
	    	'team',
	      	'advanced',
	      	'high'
	  	);
	}


	public function team_member_meta_callback($post) { 
	    wp_nonce_field( basename(__FILE__), 'team_member_nonce');    
	    $routine_store_meta=get_post_meta($post->ID);

	    $short_bio=(get_post_meta($post->ID,'short_bio',true)) ? get_post_meta($post->ID,'short_bio',true) : '';
	    $member_designation=(get_post_meta($post->ID,'member_designation',true)) ? get_post_meta($post->ID,'member_designation',true) : '';
	    $member_location=(get_post_meta($post->ID,'member_location',true)) ? get_post_meta($post->ID,'member_location',true) : '';

	    $member_facebook=(get_post_meta($post->ID,'member_facebook',true)) ? get_post_meta($post->ID,'member_facebook',true) : '';
	    $member_twitter=(get_post_meta($post->ID,'member_twitter',true)) ? get_post_meta($post->ID,'member_twitter',true) : '';
	    $member_linkedin=(get_post_meta($post->ID,'member_linkedin',true)) ? get_post_meta($post->ID,'member_linkedin',true) : '';
	    $member_youtube=(get_post_meta($post->ID,'member_youtube',true)) ? get_post_meta($post->ID,'member_youtube',true) : '';

	    ?>
	    <div class="sts__admin__content">
	      <div class="sts__admin__content__info" style="margin:0px">
	        <div class="sts__admin__content__info-item"> 
	            <label for="short_bio" class="control-label col-xs-2">Short Bio</label>
	              <textarea rows="5" class="sts__admin-input" type="text" id="short_bio" name="short_bio" placeholder="Member short bio" style="width: 100%"><?php echo $short_bio; ?></textarea>

	        </div>
			<div class="sts__admin__content__info-item">
 
	            <label for="member_designation" class="control-label col-xs-2">Designation</label>
	              <input class="sts__admin-input" type="text" id="member_designation" name="member_designation" placeholder="Designation" value="<?php echo $member_designation; ?>" />

    
	            <label for="member_location" class="control-label col-xs-2">Location </label>
	              <input class="sts__admin-input" type="text" id="member_location" name="member_location" placeholder="member Location" value="<?php echo $member_location; ?>"  />
			</div>   
	      </div>
	      <div class="row" style="margin:0px">
	        <h2 class="hndle ui-sortable-handle">Social Links</h2>
	        <div class="form-horizontal">
	            <fieldset>
	                <div class="form-group">
	                    <label for="member_facebook" class="control-label col-xs-2">Facebook</label>
	                        <input type="url" class="sts__admin-input" id="member_facebook" name="member_facebook" value="<?php echo $member_facebook; ?>" placeholder="Facebook">
	                </div>
	                    <label for="member_twitter" class="control-label col-xs-2">Twitter</label>

	                        <input type="url" class="sts__admin-input" id="member_twitter" name="member_twitter" value="<?php echo $member_twitter; ?>" placeholder="Twitter">

	                    <label for="member_linkedin" class="control-label col-xs-2">LinkedIn</label>

	                        <input type="url" class="sts__admin-input" id="member_linkedin" name="member_linkedin" value="<?php echo $member_linkedin; ?>" placeholder="LinkedIn">
	            </fieldset> 
	        </div>
	      </div>     
	    </div>
	    <?php
	 
	} // end wp_custom_attachment

	public function team_member_meta_save($post_id){
	  $is_autosave      = wp_is_post_autosave($post_id);
	  $is_revision      = wp_is_post_revision($post_id);

	  $is_valid_nonce   = (isset($_POST['team_member_nonce']) && wp_verify_nonce($_POST['team_member_nonce'], basename(__FILE__)))? 'true' : 'false';

	  if($is_autosave || $is_revision || !$is_valid_nonce){
	    return;
	  }
	  if(isset($_POST['short_bio'])){
	    update_post_meta($post_id,'short_bio',sanitize_text_field($_POST['short_bio']));
	  }
	  if(isset($_POST['member_designation'])){
	    update_post_meta($post_id,'member_designation',sanitize_text_field($_POST['member_designation']));
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
	}


	public function team_custom_columns( $columns ) {
	    $columns = array(
	        'cb' => '<input type="checkbox" />',
	        'title' => 'Title',
	        'featured_image' => 'Image',
	        'member_location' => 'Location',
	        'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
	        'date' => 'Date'
	     );
	    return $columns;
	}


	// Register the column as sortable
	public function register_sm_sortable_columns( $columns ) {
	    $columns['member_designation'] = 'member_designation';

	    return $columns;
	}


	public function team_custom_columns_data( $column, $post_id ) {
	    switch ( $column ) {
	      case 'featured_image':
	          echo the_post_thumbnail( array(40,40) );
	          break;
	        case 'member_designation':
	      $member_designation = get_post_meta( $post_id, 'member_designation', true );
	      echo $member_designation;
	      break;
	    }
	}
	

	
}

new TeamPostMeta();