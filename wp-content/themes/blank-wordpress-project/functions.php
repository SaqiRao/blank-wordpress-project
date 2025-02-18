<?php
// Add scripts and stylesheets
function enqueue_bootstrap_scripts() {
    wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
    // Enqueue Bootstrap CSS (Optional, if you haven't already added it)
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', false, '5.3.0-alpha1');

    // Enqueue WordPress's built-in jQuery
    wp_enqueue_script('jquery');

    // Enqueue Popper.js (Required for Bootstrap components like tooltips, popovers, dropdowns)
    wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', array(), '2.11.6', true);

    // Enqueue Bootstrap JS (Bootstrap's main JS file that depends on Popper.js)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js', array('popper-js'), '5.3.0-alpha1', true);

    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom-js.js', array('jquery'), null, true);

    // Localize the script to pass PHP variables to JS
    wp_localize_script('custom-js', 'custom_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'), // URL for the AJAX request
        'nonce' => wp_create_nonce('custom_nonce')  // Security nonce for the request
    ));
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
    $args = array(
        'labels' => array(
            'name' => 'Projects',
            'singular_name' => 'Project',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'projects'), // Archive page URL
        'show_in_rest' => true, // Enable Gutenberg
        'supports' => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('projects', $args);
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

// Add AJAX action for fetching projects
function load_projects_ajax() {
    // Check nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'custom_nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce.'));
    }

    // Create the query to get Projects
    $args = array(
        'post_type' => 'projects', // The custom post type
        'posts_per_page' => 3,     // Limit to 3 projects for this example
    );

    $projects_query = new WP_Query($args);
    $projects = array();

    if ($projects_query->have_posts()) {
        while ($projects_query->have_posts()) : $projects_query->the_post();
            $projects[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_permalink(),
            );
        endwhile;

        wp_send_json_success(array('data' => $projects)); // Send the data back to JS
    } else {
        wp_send_json_error(array('message' => 'No projects found.'));
    }

    wp_reset_postdata();
}

add_action('wp_ajax_load_projects', 'load_projects_ajax'); 
add_action('wp_ajax_nopriv_load_projects', 'load_projects_ajax'); 


// Fetch the random coffee API
function hs_give_me_coffee() {
    // Fetch the random coffee API
    $response = wp_remote_get('https://randomcoffeeapi.com/api/v1/coffee');
    
    
    if (is_wp_error($response)) {
        return 'Error fetching coffee link';
    }

    
    $data = wp_remote_retrieve_body($response);

    
    $coffee_data = json_decode($data);
    return isset($coffee_data->link) ? $coffee_data->link : 'No coffee link found';
} 

function get_kanye_quotes() {
    $quotes = [];

    // Fetch 5 Kanye quotes from the Kanye West API
    for ($i = 0; $i < 5; $i++) {
        $response = wp_remote_get('https://api.kanye.rest');
        
        // Check for errors in the API response
        if (is_wp_error($response)) {
            return ['Error fetching quotes'];
        }

        // Get the body of the response
        $data = wp_remote_retrieve_body($response);

        // Decode the JSON response and store the quote
        $quote_data = json_decode($data);
        $quotes[] = isset($quote_data->quote) ? $quote_data->quote : 'No quote found';
    }

    return $quotes;
}

function theme_setup() {
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'theme_setup');

