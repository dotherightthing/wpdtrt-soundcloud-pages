<?php
/**
 * SoundCloud Pages Single Post (wpdtrt-soundcloud-pages-single.php)
 * ------------------------
 * Display page title and page content.
 * Display SoundCloud HTML5 Widget Player
 * Display an "Edit" link for logged-in users with edit permissions.
 *
 * @link https://codex.wordpress.org/Theme_Development
 */
?>
<?php get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <!-- START .header -->
    <div class="header">
        <?php the_title( '<h2>', '</h2>', true ); ?>
        <?php the_excerpt(); ?>
    </div>
    <!-- END .header -->

    <!-- START #main -->
    <div id="main" <?php post_class(); ?>>

        <?php the_content(); ?>

        <?php
            /**
             * Comments
             * @link https://make.wordpress.org/themes/handbook/review/required/#core-functionality-and-features
             */
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        ?>

        <div id="soundcloud-player"></div>

    </div>
    <!-- END #main -->

    <?php endwhile ?>

    <div id="related" class="nav">
        <?php get_sidebar('sidebar-1'); ?>
    </div>
    <!-- END #related -->

<?php get_footer(); ?>
