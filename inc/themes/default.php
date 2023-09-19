<div class="sts__content">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php 
              $meta = (object)get_post_meta( get_the_ID());                   
            ?>
        <div class="sts__item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="sts__image">
            <?php the_post_thumbnail(array(213, 168),array('class'=>'sts__image-img')); ?>
            <div class="sts__image-icon">
              <?php if($meta->member_location[0] == "AR"): ?>
                        <img src="<?php echo TEAM_URL.'img/argentina.png'; ?>">
              <?php endif; ?>
              <?php if($meta->member_location[0] == "PE"): ?>
                        <img src="<?php echo TEAM_URL.'img/peru.png'; ?>">
              <?php endif; ?>
              <?php if($meta->member_location[0] == "BO"): ?>
                        <img src="<?php echo TEAM_URL.'img/bolivia.png'; ?>">
              <?php endif; ?>
              <?php if($meta->member_location[0] == "BR"): ?>
                        <img src="<?php echo TEAM_URL.'img/brasil.png'; ?>">
              <?php endif; ?>
            </div>
          </div>
          <div class="sts__info">
            <h4 class="sts__name"><?php the_title(); ?></h4>
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