<?php
/**
 * Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$classes = '';
if( !empty( $block['className'] ) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}

$allowed_blocks = array('core/columns');
$template = array( 'core/columns' );
echo
'<div class="section ' . esc_attr($classes) . '">
    <InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '"/>
</div>';