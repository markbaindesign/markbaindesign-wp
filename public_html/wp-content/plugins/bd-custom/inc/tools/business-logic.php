<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * All tools sorted oldest-first, with category + date range resolved,
 * ready for the timeline archive template.
 */
function bd324_get_tools_timeline()
{
    $query = new WP_Query([
        'post_type'      => 'bd324_tools',
        'posts_per_page' => -1,
        'orderby'        => 'meta_value_num',
        'meta_key'       => 'start_date',
        'order'          => 'ASC',
    ]);

    $tools = [];
    foreach ($query->posts as $post) {
        $tools[] = bd324_get_tool_base_data($post->ID);
    }
    wp_reset_postdata();

    return $tools;
}

function bd324_get_tool_base_data($tool_id)
{
    if (empty($tool_id) || get_post_type($tool_id) !== 'bd324_tools') {
        return null;
    }

    $categories = get_the_terms($tool_id, 'tool-category');
    $category   = ($categories && !is_wp_error($categories)) ? $categories[0] : null;

    $start_date  = get_field('start_date', $tool_id);
    $sunset_date = get_field('sunset_date', $tool_id); // entered legacy-only status
    $end_date    = get_field('end_date', $tool_id);    // dropped everywhere

    // status: 'current' (still adopted for new work), 'sunset' (legacy
    // projects only), or 'ended' (dropped everywhere).
    if ($end_date) {
        $status = 'ended';
    } elseif ($sunset_date) {
        $status = 'sunset';
    } else {
        $status = 'current';
    }

    return [
        'ID'            => $tool_id,
        'name'          => html_entity_decode(get_the_title($tool_id), ENT_QUOTES),
        'note'          => get_the_excerpt($tool_id) ?: wp_strip_all_tags(get_post_field('post_content', $tool_id)),
        'url'           => get_field('url', $tool_id) ?: '',
        'start_date'    => $start_date,
        'start_year'    => $start_date ? substr($start_date, 0, 4) : '',
        'sunset_date'   => $sunset_date,
        'sunset_year'   => $sunset_date ? substr($sunset_date, 0, 4) : '',
        'end_date'      => $end_date,
        'end_year'      => $end_date ? substr($end_date, 0, 4) : '',
        'status'        => $status,
        'is_current'    => $status === 'current',
        'category_name' => $category ? html_entity_decode($category->name, ENT_QUOTES) : '',
        'category_slug' => $category ? $category->slug : '',
    ];
}

/**
 * Category terms in use, for the filter pill list.
 */
function bd324_get_tool_categories()
{
    $terms = get_terms([
        'taxonomy'   => 'tool-category',
        'hide_empty' => true,
    ]);

    return (!is_wp_error($terms)) ? $terms : [];
}

/**
 * Ymd string ("20240315") -> ISO date string ("2024-03-15") for JS Date parsing.
 */
function bd324_tools_ymd_to_iso($ymd)
{
    return substr($ymd, 0, 4) . '-' . substr($ymd, 4, 2) . '-' . substr($ymd, 6, 2);
}

/**
 * Tools grouped into category tracks with non-overlapping lanes assigned
 * one row per tool (no overlap-packing — every tool keeps its own lane),
 * as plain data for the D3-driven Gantt chart. All date math and
 * pixel/scale work happens client-side.
 */
function bd324_get_tools_gantt_json()
{
    $tools = bd324_get_tools_timeline();
    if (empty($tools)) {
        return null;
    }

    $today = date('Ymd');

    $by_category = [];
    foreach ($tools as $t) {
        $by_category[$t['category_slug']]['name']  = $t['category_name'];
        $by_category[$t['category_slug']]['tools'][] = $t;
    }
    ksort($by_category);

    $tracks = [];
    foreach ($by_category as $category_slug => $cat) {
        $placed = [];
        foreach ($cat['tools'] as $lane => $t) {
            $end_date = $t['end_date'] ?: $today; // bar's right-hand (recent) edge

            $placed[] = [
                'id'        => $t['ID'],
                'name'      => $t['name'],
                'note'      => $t['note'],
                'url'       => $t['url'],
                'start'     => bd324_tools_ymd_to_iso($t['start_date']),
                'sunset'    => $t['sunset_date'] ? bd324_tools_ymd_to_iso($t['sunset_date']) : null,
                'end'       => bd324_tools_ymd_to_iso($end_date),
                'status'    => $t['status'],
                'isCurrent' => $t['is_current'],
                'lane'      => $lane,
            ];
        }

        $tracks[] = [
            'category'  => $cat['name'],
            'slug'      => $category_slug,
            'laneCount' => count($placed),
            'tools'     => $placed,
        ];
    }

    return [
        'today'  => bd324_tools_ymd_to_iso($today),
        'tracks' => $tracks,
    ];
}
