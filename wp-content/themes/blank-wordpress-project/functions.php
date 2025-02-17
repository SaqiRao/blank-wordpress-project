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


require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

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

  function redirect_ip_based() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (strpos($ip, '77.29') === 0) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'redirect_ip_based');

// Register 'Projects' custom post type
function create_projects_post_type() {
    register_post_type('projects', [
        'labels' => [
            'name' => 'Projects',
            'singular_name' => 'Project',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'taxonomies' => ['project_type'],
    ]);
}
add_action('init', 'create_projects_post_type');

// Register 'Project Type' taxonomy
function create_project_type_taxonomy() {
    register_taxonomy('project_type', 'projects', [
        'label' => 'Project Types',
        'hierarchical' => true,
    ]);
}
add_action('init', 'create_project_type_taxonomy');
