<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { print '-'; single_post_title(); print '-'; }
        elseif ( is_page() ) { print '-'; single_post_title(''); print '-'; }
        else { print '-'; bloginfo('name'); print '-'; }
    ?></title>
 
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
 
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,600,300italic,600italic|Source+Code+Pro:300,600|Source+Serif+Pro:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri() ?>/img/favicon.png" />
 
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
 
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'hbd-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'hbd-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <script language="JavaScript" src="<?php echo get_stylesheet_directory_uri() ?>/novel.js" type="text/javascript"></script>
</head>
<body class="loadFix">
<div id="container" >
    <header class="row masthead" role="banner">
        <a href="/"  class="col">
            <span class="bannerTitle">-Zach Fedor-</span>
        </a>

        <div id="access" class="col">
        <?php if (function_exists(clean_custom_menus())) clean_custom_menus(); ?>
        </div><!-- #access -->
 			
    </header><!-- .masthead -->
    <div class="mastback"></div>
