<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

// Configuration for metaboxes
function bd324_get_metabox_config()
{
    return [
        'bd324_projects' => [
            'metaboxes' => [
                [
                    'id' => 'related_clients_metabox',
                    'title' => 'Related Clients',
                    'field_name' => 'related_client',
                    'target_post_type' => 'bd324_clients'
                ],
                [
                    'id' => 'related_testimonials_metabox',
                    'title' => 'Related Testimonials',
                    'field_name' => 'related_testimonials',
                    'target_post_type' => 'bd324_testimonials'
                ]
            ]
        ],
        'bd324_clients' => [
            'metaboxes' => [
                [
                    'id' => 'related_projects_metabox',
                    'title' => 'Related Projects',
                    'field_name' => 'related_projects',
                    'target_post_type' => 'projects'
                ],
                [
                    'id' => 'related_testimonials_metabox',
                    'title' => 'Related Testimonials',
                    'field_name' => 'related_testimonials',
                    'target_post_type' => 'bd324_testimonials'
                ]
            ]
        ],
        'bd324_testimonials' => [
            'metaboxes' => [
                [
                    'id' => 'related_projects_metabox',
                    'title' => 'Related Projects',
                    'field_name' => 'related_projects',
                    'target_post_type' => 'projects'
                ],
                [
                    'id' => 'related_clients_metabox',
                    'title' => 'Related Clients',
                    'field_name' => 'related_client',
                    'target_post_type' => 'bd324_clients'
                ]
            ]
        ]
    ];
}

// Template-sourced page notice — shown on pages whose content lives in a template file, not the editor
add_action('add_meta_boxes', 'bd324_add_template_source_notice');
function bd324_add_template_source_notice() {
    $screen = get_current_screen();
    if (!$screen || 'page' !== $screen->post_type) {
        return;
    }
    $post_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;
    if (!$post_id) {
        return;
    }
    $template = get_post_meta($post_id, '_wp_page_template', true);
    if (empty($template) || 'default' === $template) {
        return;
    }
    add_meta_box(
        'bd324_template_source_notice',
        'Content location',
        'bd324_render_template_source_notice',
        'page',
        'normal',
        'high',
        array('template' => $template)
    );
}

function bd324_render_template_source_notice($post, $metabox) {
    $template = esc_html($metabox['args']['template']);
    echo '<p style="margin:0">The content on this page is rendered by the template file:</p>';
    echo '<p style="margin:6px 0 0;font-family:monospace;font-size:13px;background:#f6f7f7;padding:6px 8px;border-radius:3px">';
    echo 'themes/bain-design-theme/' . $template;
    echo '</p>';
    echo '<p style="margin:6px 0 0;color:#646970">Edit that file to change headings, copy, or structure. The WP editor content area is not used.</p>';
}

// Add all metaboxes
function bd324_add_related_metaboxes()
{
    $config = bd324_get_metabox_config();

    foreach ($config as $post_type => $data) {
        foreach ($data['metaboxes'] as $metabox) {
            add_meta_box(
                $metabox['id'],
                $metabox['title'],
                'bd324_display_related_metabox',
                $post_type,
                'side',
                'high',
                $metabox // Pass metabox config as callback args
            );
        }
    }
}
add_action('add_meta_boxes', 'bd324_add_related_metaboxes');

// Universal display function
function bd324_display_related_metabox($post, $metabox)
{
    $config = $metabox['args'];
    $post_id = get_the_ID();
    $related_items = get_field($config['field_name'], $post_id);

    if (empty($related_items) || !is_array($related_items)) {
        echo '<p>No related ' . strtolower($config['title']) . ' found.</p>';
        return;
    }

    echo '<ul>';
    foreach ($related_items as $item) {
        $item_id = is_object($item) ? $item->ID : $item;
        echo '<li>';
        echo '<a href="' . get_edit_post_link($item_id) . '">';
        echo get_the_title($item_id);
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
}
