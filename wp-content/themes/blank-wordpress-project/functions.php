<?php
// Add scripts and stylesheets
function enqueue_bootstrap_scripts() {
    wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
    // Enqueue Bootstrap CSS (Optional, if you haven't already added it)
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', false, '5.3.0-alpha1');

    // Enqueue Popper.js (Required for Bootstrap components like tooltips, popovers, dropdowns)
    wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', array(), '2.11.6', true);

    // Enqueue Bootstrap JS (Bootstrap's main JS file that depends on Popper.js)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js', array('popper-js'), '5.3.0-alpha1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_scripts');



// Register a new sidebar  named 'sidebar'
function add_widget_support() {
    register_sidebar( array(
                    'name'          => 'Sidebar',
                    'id'            => 'sidebar',
                    'before_widget' => '<div>',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h2>',
                    'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'add_widget_support' );


// Register a new navigation menu
function add_Main_Nav() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
  }
 
  add_action( 'init', 'add_Main_Nav' );