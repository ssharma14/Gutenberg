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

$allowed_blocks = array('core/heading', 'core/paragraph', 'gravityforms/form');

$template = array(
    array('core/heading', array(
        'level' => 2,
        'placeholder' => 'Contact Form Title Goes Here',
        'className' => 'heading'
    )),
    array('core/paragraph', array(
        'placeholder' => 'Form Description Goes Here',
        'className' => 'description'
    )),
    array('gravityforms/form')
);

echo
'<div class="form-container ' . esc_attr($classes) . '">
    <InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" 
    template="' . esc_attr( wp_json_encode( $template ) ) . '" 
    templateLock="true" />
</div>';