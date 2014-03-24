<?php
/**
 * The default template for displaying content. Used for index/archive/search.
 * @package VisitPress
 * @since VisitPress 1.0
*/ 
?>
      <div <?php post_class('post-entry'); ?>>
        <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="post-info"><strong><?php _e( 'Author', 'visitpress' ); ?></strong>: <?php the_author_posts_link(); ?> | <strong><?php _e( 'Category', 'visitpress' ); ?></strong>: <?php the_category(', ') ?><?php the_tags( __( ' | <strong>Tags</strong>: ', 'visitpress' ), ', ', '' ); ?></p>
        <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail(); ?>
        <?php endif; ?>
        <div class="post-intro"><?php global $more; $more = 0; ?><?php the_content(); ?></div>
        <div class="continue-reading">
          <p class="full-article"><a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue reading', 'visitpress' ); ?></a> &gt;<?php if ( comments_open() ) : ?><a class="article-comments" href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a><?php endif; ?></p>
        </div>
        <p class="publish-date"><span class="publish-day"><?php the_time( 'd' ) ?></span> <span class="publish-month"><?php the_time( 'M' ) ?></span> <span class="publish-year"><?php the_time( 'Y' ) ?></span></p>
      </div>