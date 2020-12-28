<!DOCTYPE html>

<html <?php language_attributes();?> dir="ltr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="<?php esc_html_e( wp_trim_words( get_the_excerpt(), 20 ) ); ?>">
    <meta name="keywords" content="<?php esc_html_e( 'JIK-WP-THEME' ); ?>">

    <?php wp_head(); ?>

  </head>

<header>

  <div class="header-container">

    <a class="header-logo" href="<?php echo esc_url( THEME_FRONTPAGE ); ?>">

      <img src="<?php echo esc_url( THEME_IMAGES . 'JIK-WP-THEME.png' );?>" alt="" class="img-fluid">
    
    </a>

    <?php if ( function_exists(clean_custom_menus() ) ) clean_custom_menus(); ?>

  </div>

</header>

<body <?php body_class(''); ?> >
  