<?php
/**
 * Icon Content Block Template.
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

$allowed_blocks = array('core/heading', 'core/paragraph', 'core/button', 'acf/image');

$template = array(
    array( 'core/group', array(
        'className' => 'image-block'), array(
        array('acf/image', array(

        ))
    )),
    array( 'core/group', array('className' => 'content-block'), array(
        array('core/heading', array(
            'level' => 5,
            'placeholder' => 'Title Goes Here',
            'className' => 'heading'
        )),
        array('core/paragraph', array(
            'placeholder' => 'Add Content',
            'className' => 'content'
        )),
        array('core/button', array(
            'className' => 'button'
        ))
    ))
);

echo
'<div class="icon-content-block ' . esc_attr($classes) . '">
    <InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="all"/>
</div>';