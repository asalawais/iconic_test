<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_and_child_styles' );
function enqueue_parent_and_child_styles() {
    // Enqueue parent theme styles
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    
    // Enqueue child theme styles
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}

function custom_ip_redirect() {
    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Check if the IP address starts with "77.29"
    if (strpos($user_ip, '77.29') === 0) {
        // Redirect the user to a different website or page
        wp_redirect('https://example.com/'); // Change this URL to your desired redirect destination
        exit; // Make sure to exit after redirecting
    }
}
add_action( 'template_redirect', 'custom_ip_redirect' );


// Register custom post type "Projects"
function custom_post_type_projects() {
    $labels = array(
        'name'                  => _x( 'Projects', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Project', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Projects', 'Admin Menu text', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Project', 'textdomain' ),
        'edit_item'             => __( 'Edit Project', 'textdomain' ),
        'new_item'              => __( 'New Project', 'textdomain' ),
        'view_item'             => __( 'View Project', 'textdomain' ),
        'view_items'            => __( 'View Projects', 'textdomain' ),
        'search_items'          => __( 'Search Projects', 'textdomain' ),
        'not_found'             => __( 'No projects found', 'textdomain' ),
        'not_found_in_trash'    => __( 'No projects found in Trash', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Project:', 'textdomain' ),
        'all_items'             => __( 'All Projects', 'textdomain' ),
        'archives'              => __( 'Project Archives', 'textdomain' ),
        'attributes'            => __( 'Project Attributes', 'textdomain' ),
        'insert_into_item'      => __( 'Insert into project', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this project', 'textdomain' ),
        'featured_image'        => _x( 'Featured Image', 'project', 'textdomain' ),
        'set_featured_image'    => _x( 'Set featured image', 'project', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove featured image', 'project', 'textdomain' ),
        'filter_items_list'     => __( 'Filter projects list', 'textdomain' ),
        'items_list_navigation' => __( 'Projects list navigation', 'textdomain' ),
        'items_list'            => __( 'Projects list', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
    );

    register_post_type( 'projects', $args );
}
add_action( 'init', 'custom_post_type_projects' );

// Register custom taxonomy "Project Type" for "Projects" post type
function custom_taxonomy_project_type() {
    $labels = array(
        'name'              => _x( 'Project Types', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Project Type', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Project Types', 'textdomain' ),
        'all_items'         => __( 'All Project Types', 'textdomain' ),
        'parent_item'       => __( 'Parent Project Type', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Project Type:', 'textdomain' ),
        'edit_item'         => __( 'Edit Project Type', 'textdomain' ),
        'update_item'       => __( 'Update Project Type', 'textdomain' ),
        'add_new_item'      => __( 'Add New Project Type', 'textdomain' ),
        'new_item_name'     => __( 'New Project Type Name', 'textdomain' ),
        'menu_name'         => __( 'Project Type', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'project-type' ),
    );

    register_taxonomy( 'project_type', 'projects', $args );
}
add_action( 'init', 'custom_taxonomy_project_type' );




function hs_give_me_coffee() {
    // API endpoint URL
    $api_url = 'https://api.sampleapis.com/coffee/random';

    // Perform the API request using WordPress HTTP API
    $response = wp_remote_get($api_url);

    // Check if the request was successful
    if (is_wp_error($response)) {
        return 'Sorry, we are unable to fetch the coffee link at the moment.';
    }

    // Get the response body and decode it from JSON to an associative array
    $coffee_data = json_decode(wp_remote_retrieve_body($response), true);

    // Check if the API response contains the necessary data
    if (isset($coffee_data['link'])) {
        return $coffee_data['link'];
    } else {
        return 'Sorry, the coffee link is not available.';
    }
}



function get_kanye_quotes() {
    $api_url = 'https://api.kanye.rest/';

    // Perform the API request using WordPress HTTP API
    $response = wp_remote_get($api_url);

    // Check if the request was successful
    if (is_wp_error($response)) {
        return array();
    }

    // Get the response body and decode it from JSON to an associative array
    $quotes_data = json_decode(wp_remote_retrieve_body($response), true);

    return $quotes_data;
}


