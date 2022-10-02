<?php
/**
 * Column Block Template.
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
if( !empty( $block['align'] ) ) {
    $classes .= sprintf( ' align%s', $block['align'] );
}

if ( ! empty( $block['backgroundColor'] ) ) {
    $classes .=' has-background';
    $classes .= ' background-color-' . $block['backgroundColor'];
}

if(get_field('border_color') != 'none'){
    $classes .=' has-border has-border-color-' . get_field('border_color');
}

$allowed_blocks = array('core/paragraph', 'core/buttons', 'core/gallery', 'core/heading',
'acf/image', 'core/list', 'core/quote', 'core/html', 
'core/shortcode', 'core/table', 'core/video', 'acf/contact-form', 'acf/contact-information', 'tribe/events-list',
'acf/post-causes', 'core/group', 'acf/featured-post-causes', 'acf/heading-button');
$template = array( array( 'core/paragraph', array(
    'placeholder' => 'Enter content here',
) ) );
echo
'<div class="column ' . esc_attr($classes) . '">
    <InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="false"/>
</div>';