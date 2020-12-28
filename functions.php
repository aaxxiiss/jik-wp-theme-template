<?php

include('custom-functions/theme-constants.php');
include('custom-functions/custom-menu.php');

function load_stylesheets() {
  wp_register_style('stylesheet', get_template_directory_uri() . '/style.css', '', 1, 'all');
  wp_enqueue_style('stylesheet');

  wp_register_style('main-stylesheet', get_template_directory_uri() . '/dist/css/main.min.css', '', 1, 'all');
  wp_enqueue_style('main-stylesheet');
}
add_action('wp_enqueue_scripts', 'load_stylesheets');


function load_js()
{
  wp_register_script('index_js', get_template_directory_uri() . '/dist/js/main.min.js', '', 1, true);
  wp_enqueue_script('index_js');

}
add_action('wp_enqueue_scripts', 'load_js');


function jik_wp_theme_setup() {

    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_post_type_support( 'page', 'excerpt' );
    add_theme_support( 'title-tag' );
  
    register_nav_menus(
      array(
        'top-menu' => __('Top Menu', 'theme'),
      )
    );
  }
  add_action('init','jik_wp_theme_setup');