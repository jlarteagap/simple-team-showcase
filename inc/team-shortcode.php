<?php 


// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts

function create_substr($string,$start=0,$length=100){
  if(strlen($string)<=$length){
    return $string;
  }else{
    return substr($meta->short_bio[0], 0, 99);    
  }
}
add_shortcode( 'team-member', 'team_rmcc_post_listing_parameters_shortcode' );
function team_rmcc_post_listing_parameters_shortcode( $atts ) {
    ob_start();
 
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'type' => 'team',
        'order' => 'date',
        'orderby' => 'title',
        'posts' => -1,
        'category' => '',
        'theme'=>'default'
    ), $atts ) );
 
    // define query parameters based on attributes
    $options = array(
        'post_type' => $type,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
        'category_name' => $category,
    );
    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { 
        if(file_exists(TEAM_PATH.'inc/themes/'.$theme.'.php')){
          require(TEAM_PATH.'inc/themes/'.$theme.'.php');
        }else{
          require(TEAM_PATH.'inc/themes/default.php');
        }
      ?>
    <?php
        $myvariable = ob_get_clean();
        return $myvariable;
    }
}




