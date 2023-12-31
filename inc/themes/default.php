<div class="sts__content">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php 
              $meta = (object)get_post_meta( get_the_ID());                   
            ?>
        <div class="sts__item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="sts__image">
            <?php the_post_thumbnail(array(213, 168),array('class'=>'sts__image-img')); ?>
          </div>
          <div class="sts__info">
            <h4 class="sts__name"><?php the_title(); ?></h4>
            <p class="sts__name-designation"><?php echo $meta->member_designation[0]; ?></p>
          </div>
          <button class="btn btn__seemore" data-id="<?php the_ID(); ?>">Ver perfil</button>
         <div class="sts__resume" style="display: none" data-id="<?php the_ID(); ?>">
          <div class="sts__modal">
            <div class="sts__modal__content"><?php the_content() ?>
            <button href="#" class="sts__modal__close" data-id="<?php the_ID(); ?>">&times;</button></div>
          </div> 
         </div>
        </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
  </div>