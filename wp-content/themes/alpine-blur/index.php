<?php 
/*
Template Name: Index
*/

get_header(); ?>
<main class="row">
    <div class="col one-third">
        <h1>Blog</h1>
    </div>

    <div class="col two-thirds">
	<?php while ( have_posts() ) : the_post() ?>

	    <div id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
		<h2 class="entry-title col"><?php the_title(); ?></h2>

 		<div class="entry-content col">
		    <?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'hbd-theme' )  ); ?>
		    <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'hbd-theme' ) . '&after=</div>') ?>
		</div><!-- .entry-content -->

		<div class="entry-meta col">
                    <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                    <span class="entry-link"><a href="<?php the_permalink(); ?>" rel="bookmark" >Read More</a></span>
                </div><!-- .entry-meta-->

	    </div><!-- #post-<?php the_ID(); ?> -->

            <hr>

	<?php endwhile; ?>
		
	<?php /* Bottom post navigation */ ?>
	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
	    <div id="nav-below" class="pagination">
		<?php next_posts_link(__( 'Older Posts', 'hbd-theme' )) ?> - <?php previous_posts_link(__( 'Newer Posts', 'hbd-theme' )) ?>
	    </div><!-- #nav-below -->
	<?php } ?>
    </div><!-- col two-thirds -->
</main><!-- row -->

<?php get_footer(); ?>


