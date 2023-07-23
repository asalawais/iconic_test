<?php
// Plugin Name: Custom Ajax Endpoint

// Ajax endpoint to get the last published projects based on user status
add_action('wp_ajax_nopriv_get_last_projects', 'get_last_projects');
add_action('wp_ajax_get_last_projects', 'get_last_projects');

function get_last_projects() {
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => is_user_logged_in() ? 6 : 3,
        'tax_query' => array(
            array(
                'taxonomy' => 'project_type',
                'field' => 'slug',
                'terms' => 'architecture',
            ),
        ),
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $projects_query = new WP_Query($args);

    $projects = array();

    if ($projects_query->have_posts()) {
        while ($projects_query->have_posts()) {
            $projects_query->the_post();
            $projects[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_permalink(),
            );
        }
    }

    wp_reset_postdata();

    $response = array(
        'success' => true,
        'data' => $projects,
    );

    wp_send_json($response);
}
