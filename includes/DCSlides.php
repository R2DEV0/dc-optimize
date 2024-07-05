<?php

namespace DC_Optimize;

class DCSlides
{
    private static $instance;

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        add_filter('page_template', array($this, 'dc_slides_template'));
    }

    public function dc_slides_template($page_template)
    {
        if (is_page('dc-slides')) {
            $dir = plugins_url('dc-optimize/');
            $page_template = dirname(__FILE__) . '/templates/dcslides.php';
            wp_enqueue_script('dc-suite', $dir . 'public/bundles/index2.bundle.js', array('jquery'), '1.0.0.4', true);
            wp_localize_script('dc-suite', 'wpData', array('ajaxurl' => admin_url('admin-ajax.php')));
            wp_enqueue_style('dc-slides', $dir . 'public/css/slides.css', array(), '1.0.0.4');
            wp_enqueue_style( 'dc-bootstrap-css', $dir . 'public/css/bootstrap.css', array(), '1.0');
            wp_enqueue_style( 'dc-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css');
        }

        return $page_template;
    }

}