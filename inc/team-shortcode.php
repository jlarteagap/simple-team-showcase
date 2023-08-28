<?php 


// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts

add_shortcode( 'team-member', 'rmcc_post_listing_parameters_shortcode' );
function rmcc_post_listing_parameters_shortcode( $atts ) {
    ob_start();
 
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'type' => 'team',
        'order' => 'date',
        'orderby' => 'title',
        'posts' => -1,
        'category' => '',
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
    if ( $query->have_posts() ) { ?>
      <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
      <div class="bootstrap-wrapper">
        <div class="row layout" style="width:100%">
        
          <div class="image_frame">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-md-4" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="desc_wrapper">
              <?php the_post_thumbnail(array(213, 168),array('class'=>'member_img')); ?>
               <h4 class="member_name"><?php the_title(); ?></h4>
                <!-- $member_designation = get_post_meta( $post_id, 'member_designation', true ) -->
                <?php 
                  $meta = (object)get_post_meta( get_the_ID());                   
                ?>
                <div class="member_info">
                  <p class="subtitle"><?php echo $meta->member_designation[0]; ?></p>
                  <hr class="hr_color">
                  <p><?php echo $meta->short_bio[0]; ?></p>
                  <!-- <p><?php echo $meta->member_email[0]; ?></p> -->                  
                  <p class="member_links">
                    <!-- <div class="col-xs-6 col-sm-4 col-md-4"> -->
                    <?php if($meta->member_website[0]): ?>
                      <span class="pull-left imgPadding imgPadding">
                        <a title="Website" href="<?php echo $meta->member_website[0]; ?>" target="_blank">
                          <img src="<?php echo plugins_url('../img/web0.png',__FILE__);?>">
                        </a>
                      </span>
                    <?php endif;?>
                     <?php if($meta->member_email[0]): ?>
                      <span class="pull-left imgPadding imgPadding">
                        <a title="Email" href="mailto:<?php echo $meta->member_email[0]; ?>">
                        <!-- <i class="fa fa-envelope fa-2x" aria-hidden="true"></i> -->
                          <img src="<?php echo plugins_url('../img/mail.png',__FILE__); ?>">
                      </a></span>
                    <?php endif; ?>
                    <?php if($meta->member_facebook[0]): ?>
                      <span class="pull-left imgPadding imgPadding">
                        <a target="__blank" title="Facebook" href="<?php echo $meta->member_facebook[0]; ?>">
                        <!-- <i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i> -->
                        <img src="<?php echo plugins_url('../img/facebook.png',__FILE__); ?>">
                      </a></span>
                    <?php endif; ?>
                    <?php if($meta->member_twitter[0]): ?>
                      <span class="pull-left imgPadding imgPadding"><a target="__blank" title="Twitter" href="<?php echo $meta->member_twitter[0]; ?>">
                        <!-- <i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i> -->
                          <img src="<?php echo plugins_url('../img/twitter.png',__FILE__); ?>">
                      </a></span>
                    <?php endif; ?>
                    <?php if($meta->member_linkedin[0]): ?>
                      <span class="pull-left imgPadding"><a target="__blank" title="LinkedIn" href="<?php echo $meta->member_linkedin[0]; ?>">
                        <!-- <i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i> -->
                          <img src="<?php echo plugins_url('../img/linkedin.png',__FILE__); ?>">
                      </a></span>
                    <?php endif; ?>
                    <?php if($meta->member_youtube[0]): ?>
                      <span class="pull-left imgPadding"><a target="__blank" title="Youtube" href="<?php echo $meta->member_youtube[0]; ?>">
                        <!-- <i class="fa fa-youtube-play fa-2x" aria-hidden="true"></i> -->
                          <img src="<?php echo plugins_url('../img/youtube.png',__FILE__); ?>">
                      </a></span>
                    <?php endif; ?>
                    <!-- </div> -->
                  </p>
                </div>
          
            </div>
            </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
            
            </div>
        </div>
      </div>
    <?php
        $myvariable = ob_get_clean();
        return $myvariable;
    }
}


