<?php
/**
 * Bain_Nav_Walker — renders sub-menus as ASCII tree dropdowns.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Bain_Nav_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '<ul class="nav-dropdown" aria-hidden="true">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $id = 0 ) {
		$item    = $data_object;
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$classes[] = 'has-dropdown';
		}
		$class_names = implode( ' ', array_filter( $classes ) );

		$atts = array(
			'href'   => ! empty( $item->url ) ? $item->url : '#',
			'target' => ! empty( $item->target ) ? $item->target : '',
			'rel'    => ! empty( $item->xfn ) ? $item->xfn : '',
			'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
		);
		$atts = array_filter( $atts );

		$attr_str = '';
		foreach ( $atts as $attr => $val ) {
			$attr_str .= ' ' . $attr . '="' . esc_attr( $val ) . '"';
		}

		$output .= '<li class="' . esc_attr( $class_names ) . '">';

		if ( $depth > 0 ) {
			$output .= '<span class="nav-tree-char" aria-hidden="true"></span>';
		}

		$output .= '<a' . $attr_str . '>' . esc_html( $item->title );
		if ( $depth === 0 && in_array( 'menu-item-has-children', $classes ) ) {
			$output .= '<span class="nav-dropdown-arrow" aria-hidden="true"> ↓</span>';
		}
		$output .= '</a>';
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}
