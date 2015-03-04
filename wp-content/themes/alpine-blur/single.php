<?php get_header(); ?>
<main id="post-content" >
    <div class="row"> 
        <div class="col one-third">
            <h1>Blog</h1>
        </div>
                        
        <div class="col two-thirds">
            <?php the_post(); ?>

            <h2 class="entry-title"><?php the_title(); ?></h2>
            
            <?php the_content(); ?>
            <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'hbd-theme' ) . '&after=</div>') ?>
        </div><!-- end content -->
    </div><!-- .row -->
    <div class="row">
        <div id="post-tools">                    
            <div class="col two-thirds offset-one-left entry-utility">
                <?php printf( __( 'This entry was posted in %1$s%2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%5$s" title="Comments RSS to %4$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', 'hbd-theme' ),
                get_the_category_list(', '),
                get_the_tag_list( __( ' and tagged ', 'hbd-theme' ), ', ', '' ),
                get_permalink(),
                the_title_attribute('echo=0'),
                comments_rss() ) ?>
            </div>
         
            <div id="nav-below" class="col navigation">
                <?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?> <span style="color: #bbb;">&#8226;</span> <?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?>
            </div><!-- #nav-below -->     
        </div><!-- #post-tools -->
    </div><!-- .row -->
</main><!-- #post-content -->
<?php get_footer(); ?>



