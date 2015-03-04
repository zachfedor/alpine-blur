<?php get_header(); ?>
 
<?php the_post(); ?>
 
<main id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
    <div class="col one-third">
        <h1><?php the_title(); ?></h1>
    </div>
    <div class="col two-thirds entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'your-theme' ) . '&after=</div>') ?>
        <?php edit_post_link( __( 'Edit', 'your-theme' ), '<span class="edit-link">', '</span>' ) ?>
    </div><!-- .entry-content -->
</main><!-- #post-<?php the_ID(); ?> -->           
 
<?php get_footer(); ?>
