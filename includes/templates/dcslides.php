<?php
get_header();

$dc_slides_post = get_option('dc_presenter_post');

if (rcp_user_can_access(get_current_user_id(), $dc_slides_post)) {
    
    $args = array(
        'post_type'      => 'envira',
        'posts_per_page' => -1, // Retrieve all galleries
        'post_status'    => 'publish', // Only fetch published galleries
    );
    
    $gallery_posts = get_posts($args);
    
    // Array to store gallery objects with id and title
    $gallery_data = array();
    
    foreach ($gallery_posts as $post) {
        $gallery_data[] = (object) array(
            'id'    => $post->ID,
            'title' => $post->post_title,
        );
    }
    
    // Encode gallery data as JSON for passing to JavaScript
    $gallery_data_json = json_encode($gallery_data);

    ?>
        <div class="dcslides" id="dc-slides" data-ids="<?php echo esc_attr($gallery_data_json); ?>"></div>
    <?php

    if ( function_exists( 'envira_gallery' ) ) { 
        envira_gallery( isset($_GET['gallery_id']) ? intval($_GET['gallery_id']) : 0 ); 
    };

} else {
    ?>
        <p>You need a valid membership to access this content. Please <a href="<?php echo wp_login_url(); ?>">login</a> or <a href="<?php echo wp_registration_url(); ?>">register</a>.</p>
    <?php
}

get_footer();
?>

