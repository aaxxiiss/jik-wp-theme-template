<?php get_header(); ?>

<main>

    <div class="container">

        <h1><?php _e( 'Page Not Found', 'JIK-WP_THEME' ); ?></h1>

        <p><?php _e( 'The page you were looking for could not be found.', 'JIK-WP_THEME' ); ?></p>

        <a href="<?php echo esc_url( THEME_FRONTPAGE ); ?>">

            <span><?php _e('Get back to to homepage', 'JIK-WP-THEME') ?></span>
            
        </a>

    
    </div>

</main>

<?php get_footer(); ?>