<?php /* Template Name: Custom Homepage */ ?>
<?php get_header(); ?>

<?php while (have_posts()) : the_post();
the_content();
endwhile; ?>
   
<?php get_footer(); ?>